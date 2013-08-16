<?php
session_start();
unset($_SESSION['debbane_admin']);
unset($_SESSION['debbane_user']);
header("Location: ../index");
exit();
?>