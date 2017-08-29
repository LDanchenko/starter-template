<?php
require_once('config.php');
$login = $_POST['login'];
//тут регулярка
$hash = str_replace("<th>","",$login);
$r =  str_replace("</th>","",$login);
//echo $r;


//echo json_encode($r);


$stmt = $mysqli->stmt_init(); //начало подготовки запроса
$stmt->prepare('DELETE FROM users WHERE login = ?'); //подготовка запроса
$stmt->bind_param('s', $login);//указываем параметры запроса
$stmt->execute();//выполняем
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива

