<?php
require_once('config.php');
$_SESSION['userid'] = null;
header('Location: index.php');
exit;
?>