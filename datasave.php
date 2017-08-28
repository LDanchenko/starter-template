<?php
require_once('config.php');
$username = $_POST['username'];
$birthday = $_POST['birthday'];
$description = $_POST['description'];
$userid = $_SESSION['userid'];
//инсертим данные
$stmt = $mysqli->stmt_init(); //начало подготовки запроса

$stmt->prepare('UPDATE users SET users.username = "' . $username . '", users.age = "' . $birthday . '", users.description = "' . $description . '" 
WHERE id = ?');

$stmt->bind_param('i', $userid);//указываем параметры запроса
$stmt->execute();//выполняем
$result = $stmt->get_result();
//$data = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива

//echo json_encode($exist);