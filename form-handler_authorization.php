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

   // echo $exist; //сомнительное возвращение данных + долго гоняет данные
    //проверяем пароль

    if (password_verify($passwd, $hash)) {
        $exist = 1;
        echo $exist;  //пароль прошел
    } else {
        $exist = 2;
        echo $exist; //пароль не подошел
    }
} //если такого пользователя нет
else {
    $exist = 0;
    echo $exist;
}
