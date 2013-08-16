<?php
$link=$_REQUEST['link'];
if (!file_exists($link)){
	session_start();
	if($_SESSION['lang']=="") $_SESSION['lang']="en";
	if($_REQUEST['lang']) $lang=$_SESSION['lang']=$_REQUEST['lang'];
	else $lang=$_SESSION['lang'];
	include_once "../labels/labels_$lang.php";
	echo "<html><head><title>404</title><head><body dir='".pageDir."'>";
	echo _FileDoesNotExist;
	echo "</body></html>";
	exit();
}
$contents=file_get_contents($link);
// Send Header
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-type: application/pdf');

header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Type: application/force-download");
header('Content-Disposition: attachment; filename='.basename($link));
header("Content-Transfer-Encoding: binary ");
echo $contents;
?>