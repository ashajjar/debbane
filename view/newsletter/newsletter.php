<?php
include_once '../../common/database.php';
include_once '../includes/utils.php';
include_once "../labels/labels_$lang.php";
$email=$_REQUEST['email'];
$name=$_REQUEST['name'];

if($email=="")
{
	echo _EnterEmail;
	exit();
}
if($name=="")
{
	echo _EnterName;
	exit();
}

$sql="SELECT * FROM `newsletter` WHERE `email`='$email'; ";
$subscription=mysql_query($sql);
if (mysql_num_rows($subscription)>0)
{
	$id= mysql_result($subscription,0,"id");
	$sub= mysql_result($subscription,0,"isActive");
	$registeredName= mysql_result($subscription,0,"name");
	if($name!=$registeredName)
	{
		echo _EmailDontMatchName;
		exit();
	}
	if($sub==1)
	{
		$sql="UPDATE `newsletter` SET `isActive`='0' WHERE id=$id;";
		if(mysql_query($sql))
		{
			echo _Unsubscribtion_done;
			exit();
		}
		else
		{
			echo _Unsubscribtion_failed;
			exit();
		}
	}
	else
	{
		$sql="UPDATE `newsletter` SET `isActive`='1' WHERE id=$id;";
		if(mysql_query($sql))
		{
			echo _Resubscribtion_done;
			exit();
		}
		else
		{
			echo _Resubscribtion_failed;
			exit();
		}
	}
}
else 
{
	$sql="INSERT INTO `newsletter` ( `id` , `email` , `name` , `isActive` )
				VALUES (NULL , '$email', '$name', '1');";
	if(mysql_query($sql))
	{
		echo _Subscribtion_done;
		exit();
	}
	else 
	{
		echo _Subscribtion_failed;
		exit();
	}
}
?>