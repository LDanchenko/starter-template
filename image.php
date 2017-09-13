<?php
require_once("config.php");
// include composer autoload
require 'vendor/autoload.php';
use Intervention\Image\ImageManager;


function changeImage()
{

// create an image manager instance with favored driver
    $manager = new ImageManager(array('driver' => 'imagick'));

//выираем все фотки
    $mysqli = connect();
    $stmt = $mysqli->stmt_init(); //начало подготовки запроса
    $stmt->prepare('SELECT  users.photo FROM users'); //подготовка запроса
    $stmt->execute();//выполняем
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива


    foreach ($data as $arr => $massiv) {
        foreach ($massiv as $inner_key => $value) {

            if (isset($value)) {

                $image = $manager->make($value)->rotate(45)->save();
                $image = $manager->make($value)->insert('uploads/watermark.png')->save();
                $image = $manager->make($value)->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();
            }
        }
    }
}


?>


