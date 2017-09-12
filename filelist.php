<?php
require_once("config.php");
require_once("vendor/autoload.php");
use Intervention\Image\ImageManager;
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true

));
//тут как вынести в функции???
$stmt = $mysqli->stmt_init(); //начало подготовки запроса
$stmt->prepare('SELECT  users.photo FROM users'); //подготовка запроса
$stmt->execute();//выполняем
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива


/*//все картинки меняем
// create an image manager instance with favored driver
$manager = new ImageManager(array('driver' => 'imagick'));


// create Image from file
$img = Image::make('public/foo.jpg');

// rotate image 45 degrees clockwise
$img->rotate(-45);
*/

echo $twig->render('filelist.html', array('session' => isset($_SESSION['userid']), 'data' => $data));
?>
