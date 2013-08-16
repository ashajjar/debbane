<?php
session_start();
if(!isset($_SESSION['debbane_admin'])){
	header("Location:../index/login.php");
	exit();
}
?>