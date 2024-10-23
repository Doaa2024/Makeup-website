<?php
session_start();
$_SESSION = array();
session_destroy();
if (isset($_COOKIE[session_name()]))
    setcookie(session_name(), '', time() - 86400, '/');
if (isset($_COOKIE['UserName']))
    setcookie('UserName', '', time() - 86400, '/');
header("Location:login.php");
exit();
