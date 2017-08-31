<?php
require_once('config.php');
$login = $_POST['login'];
//тут регулярка
$hash = str_replace("<th>","",$login);
$r =  str_replace("</th>","",$login);
//echo $r;


//echo json_encode($r);


$stmt = $mysqli->stmt_init(); //начало подготовки запроса
//удаляем картинку
$stmt->prepare('SELECT photo FROM users WHERE login = ?'); //подготовка запроса
$stmt->bind_param('s', $login);//указываем параметры запроса
$stmt->execute();//выполняем
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
$path = $data[0]['photo'];//путь к картинке
unlink($path);
//удаляем из базы
$stmt->prepare('DELETE FROM users WHERE login = ?'); //подготовка запроса
$stmt->bind_param('s', $login);//указываем параметры запроса
$stmt->execute();//выполняем
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива

