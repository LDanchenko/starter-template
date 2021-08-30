<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//__DIR__.
require 'vendor/autoload.php';
function send($login)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
      //  $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.yandex.ua';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = *********;                 // SMTP username
        $mail->Password = '*******8';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        $mail->CharSet = "UTF-8";

        //Recipients
        $mail->setFrom(********88', 'Администратор');
        $mail->addAddress($login);     // Add a recipient


        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Регистрация';
        $mail->Body = 'Спасибо за регистрацию на нашем сайте! Теперь авторизируйтесь.';


        $mail->send();
       // echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
