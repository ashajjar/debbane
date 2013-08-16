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
	$oldpass = addslashes ( $_POST ['oldpass'] );
	$newpass = addslashes ( $_POST ['newpass'] );
	$confirmpass = addslashes ( $_POST ['confirmpass'] );

	if($newpass!=$confirmpass){
		echo _PasswordConfirmationError;
	}
	else{
		$username=$_SESSION['debbane_user'];
		$sql="SELECT * FROM `user` WHERE `username`='$username' AND `password`=MD5('$oldpass');";
		$result=mysql_query($sql);
		$rows=mysql_num_rows($result);
		if($rows>0){
			$id=mysql_result($result, 0,'id');
			$sql = "UPDATE `user` SET `password`=md5('$newpass') WHERE `id`='$id';";
			if (mysql_query ( $sql )) {
				echo "<script>document.location='../';</script>";
			} else {
				echo "<span class='error'>"._PWChangeFailed."</span>";
			}
		}
		else {
			echo "<span class='error'>"._WrongPassword."</span>";
		}
	}
}

?>
<h1 class="catTitle"><?=_ChangePass?></h1>

<table cellpadding="5" cellspacing="0" width="770px" align="center" border="0">
	<tr class="innerCategory">
		<td valign="top" align="center">
			<form action="<?=$_SERVER ['PHP_SELF']?>" method="post"
				enctype="multipart/form-data">
				<table align="center" width="770px">
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_OldPass?></td>
						<td align="<?=mainDir?>"><input type="password" name="oldpass" value="" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_NewPass?></td>
						<td align="<?=mainDir?>"><input type="password" name="newpass" value="" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_ConfirmPass?></td>
						<td align="<?=mainDir?>"><input type="password" name="confirmpass" value="" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" name="submit" value="<?=_Change?>" /></td>
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