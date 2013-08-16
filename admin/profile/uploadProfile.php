<?php
include_once '../common/header.php';
$submit = $_POST['submit'];
$allowedTypes=array('application/pdf');
$maxImageSize = 5 * 1024 * 1024;//5MB

if(isset($submit)){
	$error=false;
	
	if (($_FILES ["profile"] ["error"] > 0) || (!in_array($_FILES['profile']['type'], $allowedTypes))) {
		if($_FILES ["profile"]["name"]!=""){
			$imagePath="";
			$error=true;
			echo "<span class='error'>Error uploading photo : " . $_FILES ["profile"] ["error"] . "<br />Allowed types are :jpg,png or gif<br/>Maximum size is 5MB</span>";
		}
	}
	else{
		$imagePath="../../profile.pdf";
		clearUploadsCache();
		if(file_exists($imagePath)){
			unlink($imagePath);
		}
		move_uploaded_file($_FILES ["profile"]["tmp_name"], $imagePath);
	}
}


?>
<h2>Update Profile</h2>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Profile </td>
		<td><input type="file" name="profile" /></td>
	</tr>

	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /></td>
	</tr>
</table>
</form>
<?php
include_once '../common/footer.php';
?>