<?php

require_once('config.php');
$photo = $_POST['photo'];
$photo_r = str_replace("<th>", "", $photo);
$path =  str_replace("</th>", "", $photo_r);

$patterns = array();
$patterns[0] = '/.jpg/';
$patterns[1] = '/.png/';
$patterns[2] = '/.jpeg/';
$patterns[3] = '/.gif/';
$replacement = "";
$user_id_string =  preg_replace($patterns, $replacement, $path);
$user_id = (int)$user_id_string;
echo gettype($user_id);
$stmt = $mysqli->stmt_init(); //начало подготовки запроса
//удаляем ссылку на картинку из базы
$stmt->prepare('UPDATE users SET users.photo = NULL WHERE id = ?');
$stmt->bind_param('i', $user_id);//указываем параметры запроса
$stmt->execute();//выполняем

unlink('./uploads/' .$path);

?>