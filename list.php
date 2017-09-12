<?php
require_once("config.php");
require_once("vendor/autoload.php");

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true

));
//тут как вынести в функции???
$stmt = $mysqli->stmt_init(); //начало подготовки запроса
$stmt->prepare('SELECT users.login, users.username, users.age, users.description, users.photo
    FROM users'); //подготовка запроса
$stmt->execute();//выполняем
$result = $stmt->get_result();
$data1 = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива
$data = array('text' => 'first', 'text2' => 'second');

function isImage($value)
{
    if (preg_match('/uploads/', $value)) {
        return true;
}
else {
        return false;
}
}


echo $twig->render('list.html', array('session' => isset($_SESSION['userid']), 'data' => $data1));
?>




