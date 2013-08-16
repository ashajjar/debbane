<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];

if(isset($submit)){

	$name = addslashes ( $_POST ['name'] );
	$email = addslashes ( $_POST ['email'] );
	$isActive = addslashes ( $_POST ['isActive'] );

	$sql="UPDATE `newsletter` SET `name`='$name' , `email`='$email', `isActive`='$isActive' WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>document.location='newsletter.php';</script>";
	}
	else{
		echo "<span class='error'>Failed to update subscriber</span>";
	}
}

$sql = "SELECT * FROM `newsletter` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit Subscriber</h2>
<?
if ($rows > 0) {
		$id=mysql_result($result, $i,"id");
		$name=mysql_result($result, $i,"name");
		$email=mysql_result($result, $i,"email");
		$isActive=mysql_result($result, $i,"isActive");
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Name</td>
		<td><input type="text" class="required" name="name" value="<?=stripslashes ( $name )?>" />
		<input type="hidden" name="id" value="<?=stripslashes ( $id )?>" /></td>
	</tr>
	<tr>
		<td>E-Mail</td>
		<td><input type="text" name="email" class="email required" value="<?=stripslashes ( $email )?>" /></td>
	</tr>
	<tr>
		<td>Active?</td>
		<td><input type="checkbox" name="isActive" value="1" <?=($isActive)?"checked='checked'":""?> /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='newsletter.php';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected subscriber to be edited!";
}
include_once '../common/footer.php';
?>