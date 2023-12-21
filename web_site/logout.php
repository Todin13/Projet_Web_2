<?php
session_start();

$_SESSION = array();

session_destroy();

header('Location: ../web_site/home/home.php');
exit();
?>
