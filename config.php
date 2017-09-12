<?php
session_start();
$host = 'localhost';
$dbuser = 'root';
$dbpasswd = 'llddvvcc5678';
$dbname = 'db1';
$mysqli = new mysqli($host, $dbuser, $dbpasswd, $dbname);
if ($mysqli->connect_error) { //если ошибки при подключении
    die('connect error(' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

//подключим твиг
