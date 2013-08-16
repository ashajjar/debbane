<?php
if($_REQUEST['ajax']){
	include_once '../../common/database.php';
	include_once '../includes/imaging.php';
	include_once '../includes/utils.php';
	include_once "../labels/labels_$lang.php";
	header('Content-Type: text/html; charset=Windows-1256');
}
else{
	include_once '../common/header.php';
	echo "<div class='innerContainer' style='display:inline'>";
}

$submit = $_POST ['submit'];

if (isset ( $submit )) {
	$username = addslashes ( $_POST ['username'] );
	$password = rand(0, PHP_INT_MAX)."".time(); //addslashes ( $_POST ['password'] );
	$email = addslashes ( $_POST ['email'] );

	$sql="SELECT * FROM `user` WHERE `username`='$username' AND `email`='$email';";
	$result=mysql_query($sql);
	$rows=mysql_num_rows($result);
	if($rows>0){
		$id=mysql_result($result, 0,"id");
		$name=mysql_result($result, 0,"name");
		$lastName=mysql_result($result, 0,"lastName");
		
		$from=getDataCell("value", "configuration", "id", "3");
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "To:".$email."\r\n";
		$headers .= "From: ".$from." \r\n";
		$message=str_replace("##USER##", $name." ".$lastName, _RecoverPasswordEMail);
		$message=str_replace("##PASS##", $password , $message);
		$message  ="<p>$message</p>";
		
		$s = @mail($email, _RecoverPasswordMSGTitle, $message, $headers);
		if($s){
			$sql = "UPDATE `user` SET `password`=md5('$password') WHERE `id`='$id';";
			if (mysql_query ( $sql )) {
				echo "<script>document.location='../';</script>";
			} else {
				echo "<span class='error'>"._PWChangeFailed."</span>";
			}		
		} else {
			echo "<span class='error'>"._EmailSendFailed."</span>";
		}
	}
	else {
		echo "<span class='error'>"._UserEmailNotMatch."</span>";
	}
}

?>
<h1 class="catTitle"><?=_forgotPWTitle?></h1>

<table cellpadding="5" cellspacing="0" width="770px" align="center" border="0">
	<tr class="innerCategory">
		<td valign="top" align="center">
			<form action="<?=$_SERVER ['PHP_SELF']?>" method="post"
				enctype="multipart/form-data">
				<table align="center" width="770px">
					<tr>
						<td colspan="2" align="<?=mainDir?>">
						<p><?=_RecoverPasswordMsg?></p>
						</td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_username?></td>
						<td align="<?=mainDir?>"><input type="text" name="username" value="<?=stripslashes ( $username )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_EMail?></td>
						<td align="<?=mainDir?>"><input type="text" name="email" value="<?=stripslashes ( $email )?>" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" name="submit" value="Send" /></td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<?php 
if($_REQUEST['ajax']){

}
else{
	echo "</div>";
	include_once '../common/footer.php';
}
?>