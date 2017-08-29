<?php
require_once('config.php');
$login = strip_tags($_POST['login']);
$passwd = strip_tags($_POST['passwd']);
$exist = 0;
//узнаем есть ли в базе пользователь с таким логином
$stmt = $mysqli->stmt_init(); //начало подготовки запроса
$stmt->prepare('SELECT * FROM users WHERE login = ?'); //подготовка запроса
$stmt->bind_param('s', $login);//указываем параметры запроса
$stmt->execute();//выполняем
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива
if (count($data) == 1) {
$ps = $data[0]['password'];//из массива взяли пароль
$hash = str_replace("\n","",$ps); //убрать перенос строк
//если такой пользователь есть


    if (password_verify($passwd, $hash)) {
        $_SESSION['userid'] =$data[0]['id'];//сохраняем айди пользователя в сессию
        $exist = 1;//пароль прошел

    } else {
        $exist = 2; //пароль не подошел
    }
} //если такого пользователя нет
else {
    $exist = 0;
}
echo json_encode($exist);