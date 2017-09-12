<?php
require_once("config.php");
require_once ("vendor/autoload.php");

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true

));

echo $twig->render('reg.html', array('session' => isset($_SESSION['userid'])));

?>