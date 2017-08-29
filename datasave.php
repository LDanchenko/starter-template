<?php
require_once('config.php');


$uploaddir = './uploads/';
//$uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    $out = "Файл корректен и был успешно загружен.\n";
} else {
    $out = "Возможная атака с помощью файловой загрузки!\n";
}

echo $out;

$username = strip_tags($_POST['username']);
$birthday = $_POST['birthday'];
$description = strip_tags($_POST['description']);
$userid = $_SESSION['userid'];



$stmt = $mysqli->stmt_init(); //начало подготовки запроса
//апдейтим бд
$stmt->prepare('UPDATE users SET users.username = "' . $username . '", users.age = "' . $birthday . '", users.description = "' . $description . '" 
WHERE id = ?');

$stmt->bind_param('i', $userid);//указываем параметры запроса
$stmt->execute();//выполняем
$result = $stmt->get_result();
//$data = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива

//echo json_encode($exist);