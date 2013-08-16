<?php
session_start();
if($_SESSION['lang']=="") $_SESSION['lang']="en";
if($_REQUEST['lang']) $lang=$_SESSION['lang']=$_REQUEST['lang'];
else $lang=$_SESSION['lang'];
$pageDir=($lang=="ar")?"r":"l";

//include_once "../labels/labels_$lang.php";

$database = "debbane_db";
$dbUsername = "debbane_root";
$dbPassword = "!@#$%^";
$dbUsername = "root";
$dbPassword = "12345678";
$dbHostname = "localhost";

$dblink = mysql_connect($dbHostname, $dbUsername, $dbPassword) OR die("Error !! Unable to connect to database");       

// Select the database name to be used or else print error message if unsuccessful*/
@mysql_select_db($database) or die( "Unable to select database ".$database); 
//mysql_query("SET NAMES cp1256;");
?>