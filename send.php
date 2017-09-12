
<?php
require "vendor/autoload.php";
$remoteIp = $_SERVER['REMOTE_ADDR'];
$gRecaptchaResponse = $_REQUEST['g-recaptcha-response'];
$recaptcha = new \ReCaptcha\ReCaptcha("6LczSDAUAAAAACQmp3LmpFmQ-3YD5FB66rV05-Bi");
$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
if ($resp->isSuccess()) {
    echo "Успех, капча пройдена";
} else {
    echo "Поражен вашей неудачей, сударь";
}