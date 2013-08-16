<?php
session_start();
$error="";
include_once '../../common/database.php';
if($_SESSION['debbane_admin']){
	@header("Location: index.php");
	exit();
}
if($_POST['submit']){
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	$md5pass=md5($pass);
	$sql="SELECT * FROM user WHERE username='$user' AND password='$md5pass'";
	$result=mysql_query($sql);
	$numRows=mysql_num_rows($result);
	if($numRows>0){
		$_SESSION['debbane_admin']=$user;
		@header("Location: index.php");
		exit();
	}
	else {
		$error.="<span style='color:#f00;'>";
		$error.="Wrong username or password !";
		$error.="</span>";
	}
}
//include 'common/header.php';
?>
<style>
<!--
body{
	margin: 0px;
	padding: 0px;
}
-->
</style>
<table width="100%" height="100px" bgcolor="#000000">
		<tr>
			<td colspan="2" align="center">
				<img alt="" src="../includes/images/fineline.png">
			</td>
		</tr>
</table>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	<table border="0" cellpadding="2" cellspacing="2" align="center" width="300px" class="loginTable">
		<tr>
			<td colspan="2" align="center">
				<? echo $error?>
			</td>
		</tr>
		<tr>
			<td>
				Username: 
			</td>
			<td>
				<input type="text" name="user" id="user" value="">
			</td>
		</tr>
		<tr>
			<td>
				Password:
			</td>
			<td>
				<input type="password" name="pass" id="pass" value="">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="Login" />
			</td>
		</tr>
	</table>
</form>

<?php 
//include 'includes/footer.php';
?>
