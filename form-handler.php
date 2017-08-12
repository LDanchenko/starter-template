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
//если логин свободен - регистрация

if (count($data) == 0) {
    $stmt = $mysqli->stmt_init(); //начало подготовки запроса
    $stmt->prepare('INSERT INTO users (login, password) 
    VALUES ("' . $login . '", "' . $passwd . '")'); //подготовка запроса а
    $stmt->execute();//выполняем
    $exist = 0;
    echo $exist;
}
//если такой пользователь уже есть
else {
    $exist = 1;
    echo $exist;
}
