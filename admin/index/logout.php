<?php
session_start();
unset($_SESSION['debbane_admin']);
header("Location: login.php");
exit();
?>