<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST ['submit'];

if (isset ( $submit )) {
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
		
	$sql = "INSERT INTO `user` VALUES (NULL , '$name', '$lastName', '$DOB', '$certificate','$position','$employer'
	,'$username',md5('$password'),NOW(),'$email','$POBOX','$street','$city','$country','$phone','$mobile','$gruop_id');";
	if (mysql_query ( $sql )) {
		echo "<script>document.location='users.php';</script>";
	} else {
		echo "<span class='error'>Failed to insert user</span>";
	}
}

?>
<h2>New User</h2>

<form action="<?=$_SERVER ['PHP_SELF']?>" method="post"
	enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>First Name</td>
		<td><input type="text" class="required" name="name" value="<?=stripslashes ( $name )?>" />
		<input type="hidden" name="id" value="<?=stripslashes ( $id )?>" /></td>
	</tr>
	<tr>
		<td>Last Name</td>
		<td><input type="text" class="required" name="lastName" value="<?=stripslashes ( $lastName )?>" /></td>
	</tr>
	<tr>
		<td>Date of Birth</td>
		<td><input type="text" class="required dateF" name="DOB" value="<?=stripslashes ( $DOB )?>" /></td>
	</tr>
	<tr>
		<td>Certificate</td>
		<td><input type="text" class="required" name="certificate" value="<?=stripslashes ( $certificate )?>" /></td>
	</tr>
	<tr>
		<td>Position</td>
		<td><input type="text" class="required" name="position" value="<?=stripslashes ( $position )?>" /></td>
	</tr>
	<tr>
		<td>Employer</td>
		<td><input type="text" class="required" name="employer" value="<?=stripslashes ( $employer )?>" /></td>
	</tr>
	<tr>
		<td>Username</td>
		<td><input type="text" class="required" name="username" value="<?=stripslashes ( $username )?>" /></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" class="required" name="password" value="" /></td>
	</tr>
	<tr>
		<td>E-Mail</td>
		<td><input type="text" class="required email" name="email" value="<?=stripslashes ( $email )?>" /></td>
	</tr>
	<tr>
		<td>P.O.Box</td>
		<td><input type="text" class="required" name="POBOX" value="<?=stripslashes ( $POBOX )?>" /></td>
	</tr>
	<tr>
		<td>Street</td>
		<td><input type="text" class="required" name="street" value="<?=stripslashes ( $street )?>" /></td>
	</tr>
	<tr>
		<td>City</td>
		<td><input type="text" class="required" name="city" value="<?=stripslashes ( $city )?>" /></td>
	</tr>
	<tr>
		<td>Country</td>
		<td><input type="text" class="required" name="country" value="<?=stripslashes ( $country )?>" /></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td><input type="text" class="required numeric" name="phone" value="<?=stripslashes ( $phone )?>" /></td>
	</tr>
	<tr>
		<td>Mobile</td>
		<td><input type="text" class="required numeric" name="mobile" value="<?=stripslashes ( $mobile )?>" /></td>
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
include_once '../common/footer.php';
?>