<?php
require_once('config.php');
$_SESSION['userid'] = NULL;
header('Location: index.php');
exit;
?>