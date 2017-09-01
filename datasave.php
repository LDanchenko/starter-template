<?php
require_once('config.php');

$file = $_FILES['userfile'];

if (preg_match('/jpg/', $file['name']) or preg_match('/png/', $file['name']) or preg_match('/gif/', $file['name']) or  preg_match('/jpeg/', $file['name'])) {
    if (preg_match('/jpg/', $file['type']) or preg_match('/png/', $file['type']) or preg_match('/gif/', $file['type']) or  preg_match('/jpeg/', $file['name'])) {
        $uploaddir = './uploads/';
        $userid = $_SESSION['userid'];
        $name = $_FILES['userfile']['type'];
        $tmp = explode('/', $name);
        $type = end($tmp);
        $file = $userid . "." . $type;
        $uploadfile = $uploaddir . basename($file);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $out = 1;
            $filepath = $uploaddir . basename($file);
            $username = strip_tags($_POST['username']);
            $birthday = $_POST['birthday'];
            $description = strip_tags($_POST['description']);
            $stmt = $mysqli->stmt_init(); //начало подготовки запроса
//апдейтим бд
            $stmt->prepare('UPDATE users SET users.photo = "' .$filepath . '", users.username = "' . $username . '", users.age = "' . $birthday . '", users.description = "' . $description . '" 
WHERE id = ?');
            $stmt->bind_param('i', $userid);//указываем параметры запроса
            $stmt->execute();//выполняем
            $result = $stmt->get_result();
        }
        else {
            $out = 2;
        }
    }
}
else
{
    $out = 0;
}
echo $out;

