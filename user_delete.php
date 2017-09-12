<?php
require_once('config.php');
$log = $_POST['login'];
//тут регулярка
$log1 = str_replace("<th>", "", $log);
$log2 = str_replace(" ", "", $log1);
$login =  str_replace("</th>", "", $log2);
echo $login .PHP_EOL;
$stmt = $mysqli->stmt_init(); //начало подготовки запроса
//удаляем картинку
$stmt->prepare('SELECT users.id, users.photo FROM users WHERE login = ?'); //подготовка запроса
$stmt->bind_param('s', $login);//указываем параметры запроса
$stmt->execute();//выполняем
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
$path = $data[0]['photo'];//путь к картинке
print_r($data);
if (isset($path)) {
    unlink($path);
}
//удаляем из базы
$stmt->prepare('DELETE FROM users WHERE login = ?'); //подготовка запроса
$stmt->bind_param('s', $login);//указываем параметры запроса
$stmt->execute();//выполняем
//удалил сам себя - разлогинился

if ($_SESSION['userid'] == $data[0]['id']){
    $_SESSION['userid'] = NULL;
}
