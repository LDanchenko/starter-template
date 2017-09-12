<?php

function isImage($file)
{
    if (preg_match('/jpg/', $file['name']) or preg_match('/png/', $file['name']) or preg_match('/gif/', $file['name']) or preg_match('/jpeg/', $file['name']) or preg_match('/swf/', $file['name']) or preg_match('/psd/', $file['name'])  or preg_match('/psd/', $file['name']) or preg_match('/bmp/', $file['name']) or preg_match('/jpc/', $file['name']) or preg_match('/jp2/', $file['name']) or preg_match('/jpx/', $file['name']) or preg_match('/jb2/', $file['name']) or preg_match('/swc/', $file['name']) or preg_match('/iif/', $file['name']) or preg_match('/wbmp/', $file['name']) or preg_match('/xbm/', $file['name']) or preg_match('/ico/', $file['name'])) {
        if (preg_match('/jpg/', $file['type']) or preg_match('/png/', $file['type']) or preg_match('/gif/', $file['type']) or preg_match('/jpeg/', $file['type']) or preg_match('/swf/', $file['type']) or preg_match('/psd/', $file['type'])  or preg_match('/psd/', $file['type']) or preg_match('/bmp/', $file['type']) or preg_match('/jpc/', $file['type']) or preg_match('/jp2/', $file['type']) or preg_match('/jpx/', $file['type']) or preg_match('/jb2/', $file['type']) or preg_match('/swc/', $file['type']) or preg_match('/iif/', $file['type']) or preg_match('/wbmp/', $file['type']) or preg_match('/xbm/', $file['type']) or preg_match('/ico/', $file['type'])) {
            $image = 1;
        }
    } else {
        $image = 0;
    }
    return $image;
}

function selectAllUsers(){

    $stmt = $mysqli->stmt_init(); //начало подготовки запроса
    $stmt->prepare('SELECT users.login, users.username, users.age, users.description, users.photo
    FROM users'); //подготовка запроса
    $stmt->execute();//выполняем
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива
    echo "пользователь авторизован";

}