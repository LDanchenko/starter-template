<?php
require_once('config.php');
//$name = $_POST['name'];
//$birthday = $_POST['birthday'];
$name = 'f';
$birthday= date("Y-m-d");

//$description = $_POST['description'];
//$userid = $_SESSION['userid'];
//инсертим данные
$stmt = $mysqli->stmt_init(); //начало подготовки запроса
//$stmt->prepare('UPDATE users SET username = "\' . $name. \'", age = "\' . $birthday . \'", description = "\' . $birthday . \'" WHERE id = ?'); //подготовка запроса

$stmt->prepare('UPDATE users SET users.username = "' . $name . '", users.age = "2017-07-09", users.description = "dd" WHERE id = ?');
$r = 18;
$stmt->bind_param('i', $r);//указываем параметры запроса
$stmt->execute();//выполняем
$result = $stmt->get_result();
//$data = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива

//echo json_encode($exist);