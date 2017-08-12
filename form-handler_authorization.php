<?php
require_once('config.php');
$login = $_POST['login'];
$passwd = $_POST['passwd'];
$exist = 0;
//узнаем есть ли в базе пользователь с таким логином
$stmt = $mysqli->stmt_init(); //начало подготовки запроса
$stmt->prepare('SELECT * FROM users WHERE login = ?'); //подготовка запроса
$stmt->bind_param('s', $login);//указываем параметры запроса
$stmt->execute();//выполняем
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива
$ps = $data[0]['password'];
$hash = str_replace("\n","",$ps);
//если такой пользователь есть
if (count($data) == 1) {

    if (password_verify($passwd, $hash)) {
        session_start();//запустили сессию
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