<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];

if(isset($submit)){
	$name = addslashes ( $_POST ['name'] );
	$lastName = addslashes ( $_POST ['lastName'] );
	$DOB = addslashes ( $_POST ['DOB'] );
	$certificate = addslashes ( $_POST ['certificate'] );
	$position = addslashes ( $_POST ['position'] );
	$employer = addslashes ( $_POST ['employer'] );
	$username = addslashes ( $_POST ['username'] );
	$password = addslashes ( $_POST ['password'] );
	$lastLogin = addslashes ( $_POST ['lastLogin'] );
	$email = addslashes ( $_POST ['email'] );
	$POBOX = addslashes ( $_POST ['POBOX'] );
	$street = addslashes ( $_POST ['street'] );
	$city = addslashes ( $_POST ['city'] );
	$country = addslashes ( $_POST ['country'] );
	$phone = addslashes ( $_POST ['phone'] );
	$mobile = addslashes ( $_POST ['mobile'] );
	$gruop_id = addslashes ( $_POST ['gruop_id'] );
	if($password){
		$passwordUpdate=",`password`=md5('$password')";
	}
	else {
		$passwordUpdate="";
	}
	$sql="UPDATE `user` SET 
	`name`='$name',`lastName`='$lastName',`DOB`='$DOB',`certificate`='$certificate',`position`='$position',
	`employer`='$employer',`username`='$username' $passwordUpdate,`email`='$email',`POBOX`='$POBOX',
	`street`='$street',`city`='$city',`country`='$country',`phone`='$phone',`mobile`='$mobile',`gruop_id`='$gruop_id'
	WHERE `id`='$id';";
	if(mysql_query($sql)){
		echo "<script>document.location='users.php';</script>";
	}
	else{
		echo "<span class='error'>Failed to update user</span>";
	}
}

$sql = "SELECT * FROM `user` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit User</h2>
<?
if ($rows > 0) {
		$name=mysql_result($result, 0,"name");
		$lastName=mysql_result($result, 0,"lastName");
		$DOB=mysql_result($result, 0,"DOB");
		$certificate=mysql_result($result, 0,"certificate");
		$position=mysql_result($result, 0,"position");
		$employer=mysql_result($result, 0,"employer");
		$username=mysql_result($result, 0,"username");
		$password=mysql_result($result, 0,"password");
		$lastLogin=mysql_result($result, 0,"lastLogin");
		$email=mysql_result($result, 0,"email");
		$POBOX=mysql_result($result, 0,"POBOX");
		$street=mysql_result($result, 0,"street");
		$city=mysql_result($result, 0,"city");
		$country=mysql_result($result, 0,"country");
		$phone=mysql_result($result, 0,"phone");
		$mobile=mysql_result($result, 0,"mobile");
		$gruop_id=mysql_result($result, 0,"gruop_id");
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post"
	enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>First Name</td>
		<td><input type="text" name="name" class="required" value="<?=stripslashes ( $name )?>" />
		<input type="hidden" name="id" value="<?=stripslashes ( $id )?>" /></td>
	</tr>
	<tr>
		<td>Last Name</td>
		<td><input type="text" name="lastName" class="required" value="<?=stripslashes ( $lastName )?>" /></td>
	</tr>
	<tr>
		<td>Date of Birth</td>
		<td><input type="text" name="DOB" class="required dateF" value="<?=stripslashes ( $DOB )?>" /></td>
	</tr>
	<tr>
		<td>Certificate</td>
		<td><input type="text" name="certificate" class="required" value="<?=stripslashes ( $certificate )?>" /></td>
	</tr>
	<tr>
		<td>Position</td>
		<td><input type="text" name="position" class="required" value="<?=stripslashes ( $position )?>" /></td>
	</tr>
	<tr>
		<td>Employer</td>
		<td><input type="text" name="employer" class="required" value="<?=stripslashes ( $employer )?>" /></td>
	</tr>
	<tr>
		<td>Username</td>
		<td><input type="text" name="username" class="required" value="<?=stripslashes ( $username )?>" /></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="password" class="" value="" /></td>
	</tr>
	<tr>
		<td>E-Mail</td>
		<td><input type="text" name="email" class="required email" value="<?=stripslashes ( $email )?>" /></td>
	</tr>
	<tr>
		<td>P.O.Box</td>
		<td><input type="text" name="POBOX" class="required" class="required" value="<?=stripslashes ( $POBOX )?>" /></td>
	</tr>
	<tr>
		<td>Street</td>
		<td><input type="text" name="street" class="required" value="<?=stripslashes ( $street )?>" /></td>
	</tr>
	<tr>
		<td>City</td>
		<td><input type="text" name="city" class="required" value="<?=stripslashes ( $city )?>" /></td>
	</tr>
	<tr>
		<td>Country</td>
		<td><input type="text" name="country" class="required" value="<?=stripslashes ( $country )?>" /></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td><input type="text" name="phone" class="required numeric" value="<?=stripslashes ( $phone )?>" /></td>
	</tr>
	<tr>
		<td>Mobile</td>
		<td><input type="text" name="mobile" class="required numeric"  value="<?=stripslashes ( $mobile )?>" /></td>
	</tr>
	<tr>
		<td>Group</td>
		<td><?=createComboBox("usergroup", "id", "groupName", $gruop_id, "gruop_id","required")?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='users.php';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected category to be edited!";
}
include_once '../common/footer.php';
?>