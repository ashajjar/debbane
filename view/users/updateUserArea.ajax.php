<?php
include_once '../../common/database.php';
include_once '../includes/utils.php';
include_once "../labels/labels_$lang.php";
header('Content-Type: text/html; charset=Windows-1256');
if(isset($_SESSION['debbane_user'])){
	$welcomeMessage=str_replace("##USER##", $_SESSION['debbane_user'], _WelcomeUser);
	echo "<span class='welcome'>$welcomeMessage</span>";
}
elseif (isset($_SESSION['debbane_admin'])){
	$welcomeMessage=str_replace("##USER##", $_SESSION['debbane_admin'], _WelcomeUser);
	echo "<span class='welcome'>$welcomeMessage</span>";
}
else{
?>

<form action="#" method="post">
	<table cellpadding="1" cellspacing="0" width="100%" border="0" align="center">
		<tr>
			<td>
				<input type="text" name="user" id="user" value="<?=_username?>"
				onblur="if(this.value=='')this.value='<?=_username?>';"
				onfocus="if(this.value=='<?=_username?>')this.value='';">
			</td>
			<td>
				<input type="password" name="pass" id="pass" value="<?=_password?>"
				onblur="if(this.value=='')this.value='<?=_password?>';"
				onfocus="if(this.value=='<?=_password?>')this.value='';">
			</td>
			<td>
				<input type="button" name="submit" id="doUserLogin" value="" />
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<span class="loginLinks"><a href="../users/forgotPassword.php" class="loadLink"><?=_forgotPW?> </a> | <a href="../users/register.php" class="loadLink"><?=_Register?></a></span>
			</td>
		</tr>
	</table>
</form>
<?php } ?>