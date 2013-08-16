<?php
include_once '../../common/database.php';
include_once '../includes/utils.php';
include_once "../labels/labels_$lang.php";

$username=$_REQUEST['username'];
$password=$_REQUEST['password'];

if($username=="")
{
	echo _EnterUsername;
	exit();
}
if($password=="")
{
	echo _EnterPassword;
	exit();
}

$sql="SELECT * FROM `user` WHERE `username`='$username' AND `password`=MD5('$password'); ";
$result=mysql_query($sql);
if (mysql_num_rows($result)>0)
{
	$id= mysql_result($result,0,"id");
	$gruop_id= mysql_result($result,0,"gruop_id");
	$redirectTo=getDataCell("redirectTo", "usergroup", "id", $gruop_id);
	if($gruop_id=="1"){
		$_SESSION['debbane_admin']=$username;
		$sql="UPDATE `user` SET `lastlogin`=NOW() WHERE `id`='$id'; ";
		mysql_query($sql);
		echo "<script>document.location='$redirectTo';</script>";
		exit();
	}
	else {
		$_SESSION['debbane_user']=$username;
		$sql="UPDATE `user` SET `lastlogin`=NOW() WHERE `id`='$id'; ";
		mysql_query($sql);
		echo "1";
		//echo "<script>document.location='../';</script>";
		exit();
	}
	exit();
}
else 
{
	echo _LoginFailed;
	exit();
}
?>