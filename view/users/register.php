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
	$name = addslashes ( $_POST ['name'] );
	$lastName = addslashes ( $_POST ['lastName'] );
	$DOB = addslashes ( $_POST ['DOB'] );
	$certificate = addslashes ( $_POST ['certificate'] );
	$position = addslashes ( $_POST ['position'] );
	$employer = addslashes ( $_POST ['employer'] );
	$username = addslashes ( $_POST ['username'] );
	$password = rand(0, PHP_INT_MAX)."".time(); //addslashes ( $_POST ['password'] );
	$lastLogin = addslashes ( $_POST ['lastLogin'] );
	$email = addslashes ( $_POST ['email'] );
	$POBOX = addslashes ( $_POST ['POBOX'] );
	$street = addslashes ( $_POST ['street'] );
	$city = addslashes ( $_POST ['city'] );
	$country = addslashes ( $_POST ['country'] );
	$phone = addslashes ( $_POST ['phone'] );
	$mobile = addslashes ( $_POST ['mobile'] );
	
	$from=getDataCell("value", "configuration", "id", "7"," AND `lang`='$lang'");
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "To:".$email."\r\n";
	$headers .= "From: ".$from." \r\n";
	$message=str_replace("##USER##", $name." ".$lastName, _RegisterationMessage);
	$message=str_replace("##PASS##", $password , $message);
	$message  ="<p>$message</p>";
	
	$s = @mail($email, _RegisterationMessageTitle, $message, $headers);
	if($s){
		$sql = "INSERT INTO `user` VALUES (NULL , '$name', '$lastName', '$DOB', '$certificate','$position','$employer'
		,'$username',md5('$password'),0,'$email','$POBOX','$street','$city','$country','$phone','$mobile','2');";
		if (mysql_query ( $sql )) {
			echo "<script>document.location='../';</script>";
		} else {
			echo "<span class='error'>"._RegisterationFailed."</span>";
		}		
	} else {
		echo "<span class='error'>"._RegisterationFailed."</span>";
	}
}

?>
<h1 class="catTitle"><?=_Register?></h1>

<table cellpadding="5" cellspacing="0" width="770px" align="center" border="0">
	<tr class="innerCategory">
		<td valign="top" align="center">
			<form class="ToBeValidated" action="<?=$_SERVER ['PHP_SELF']?>" method="post"
				enctype="multipart/form-data">
				<table align="center" width="770px">
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_FName?>*</td>
						<td align="<?=mainDir?>"><input type="text" class="required" name="name" value="<?=stripslashes ( $name )?>" />
						<input type="hidden" name="id" value="<?=stripslashes ( $id )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_LName?>*</td>
						<td align="<?=mainDir?>"><input type="text" class="required" name="lastName" value="<?=stripslashes ( $lastName )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_DOB?></td>
						<td align="<?=mainDir?>"><input type="text" name="DOB" value="<?=stripslashes ( $DOB )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Certificate?></td>
						<td align="<?=mainDir?>"><input type="text" name="certificate" value="<?=stripslashes ( $certificate )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Position?>*</td>
						<td align="<?=mainDir?>"><input type="text" class="required" name="position" value="<?=stripslashes ( $position )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Employer?></td>
						<td align="<?=mainDir?>"><input type="text" name="employer" value="<?=stripslashes ( $employer )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_username?>*</td>
						<td align="<?=mainDir?>"><input type="text" class="required" name="username" value="<?=stripslashes ( $username )?>" /></td>
					</tr>
					<!--<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_password?></td>
						<td align="<?=mainDir?>"><input type="password" name="password" value="" /></td>
					</tr>
					--><tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_EMail?>**</td>
						<td align="<?=mainDir?>"><input type="text" class="required email" name="email" value="<?=stripslashes ( $email )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_POBOX?></td>
						<td align="<?=mainDir?>"><input type="text" name="POBOX" value="<?=stripslashes ( $POBOX )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Street?></td>
						<td align="<?=mainDir?>"><input type="text" name="street" value="<?=stripslashes ( $street )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_City?></td>
						<td align="<?=mainDir?>"><input type="text" name="city" value="<?=stripslashes ( $city )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Country?>*</td>
						<td align="<?=mainDir?>"><input type="text" class="required" name="country" value="<?=stripslashes ( $country )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Phone?></td>
						<td align="<?=mainDir?>"><input type="text" name="phone" value="<?=stripslashes ( $phone )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Mobile?>***</td>
						<td align="<?=mainDir?>"><input type="text" class="required" name="mobile" value="<?=stripslashes ( $mobile )?>" /></td>
					</tr>
					<tr>
						<td colspan="2" align="<?=mainDir?>">
						<p><?=_RequiredFields?></p>
						<p><?=_ActiveEMail?></p>
						<p><?=_ProvideMobile?></p>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input style="font-size: 11px;" type="submit" name="submit" value="<?=_Register?>" /></td>
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