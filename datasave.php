<?php
require_once('config.php');
require_once('function.php');
$file = $_FILES['userfile'];
$im = isImage($file);
if ($im == 1) {
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
        $stmt->prepare('UPDATE users SET users.photo = "' . $filepath . '", users.username = "' . $username . '", users.age = "' . $birthday . '", users.description = "' . $description . '" 
WHERE id = ?');
        $stmt->bind_param('i', $userid);//указываем параметры запроса
        $stmt->execute();//выполняем
        $result = $stmt->get_result();
    } else {
        $out = 2;
    }
} else {
    $out = 0;
}
echo $out;
