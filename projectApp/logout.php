<?php
session_start();
session_unset();
//unset($_SESSION['login_user']);
session_destroy();
header("Location: login.php");
exit;
?>