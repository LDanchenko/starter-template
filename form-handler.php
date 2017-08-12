<?php
require_once('config.php');
$login = $_POST['login'];
$passwd = $_POST['passwd'];

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
    echo "<script>alert(\"Вы успешно зарегистрированы на сайте! Теперь авторизируйтесь\");</script>";
}
//если такой пользователь уже есть
else {
    echo "<script>alert(\"Логин занят!Выберите другой!\");</script>";
}