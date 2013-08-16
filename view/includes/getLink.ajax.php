<?php
session_start();

include_once 'utils.php';

if($_SESSION['lang']=="") $_SESSION['lang']="en";
if($_REQUEST['lang']) $lang=$_SESSION['lang']=$_REQUEST['lang'];
else $lang=$_SESSION['lang'];

include_once "../labels/labels_$lang.php";

$historyArray=$_SESSION['__HISTORY'];
if(!$historyArray){
	exit();
}
if(!is_array($historyArray)){
	exit();
}
$c=count($historyArray);
if($c<1){
	exit();
}
$link=$historyArray[$c-1];
if($link){
	$full=$_REQUEST['full'];
	$link=str_replace("ajax=1", "", $link);
	if($link[strlen($link)-1]!='?')
	{
		if(strstr($link, '?'))
		{
			$link .= "&";			
		}
		else
		{
			$link .= "?";
		}
	}
	if($full){
		$link=str_replace("..", getServerURL()._ROOT."view", $link);
	}
	echo $link.="ajax=1";
}
?>