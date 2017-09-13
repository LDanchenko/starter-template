<?php
require_once("config.php");
require_once("vendor/autoload.php");
require_once ("image.php");
use Intervention\Image\ImageManager;
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true

));

changeImage();




echo $twig->render('filelist.html', array('session' => isset($_SESSION['userid']), 'data' => $data));
?>
