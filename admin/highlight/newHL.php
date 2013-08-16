<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST ['submit'];
$imageSize = 5 * 1024 * 1024;//5MB
//Images types
$imageTypes=array('image/jpeg','image/png','image/gif');
if (isset ( $submit )) {
	$error = false;
	$link = addslashes ( $_POST ['link'] );
	$hllang = addslashes ( $_POST ['hllang'] );
	if (($_FILES ["photo"] ["error"] > 0) || ($_FILES ['photo'] ['size'] > $imageSize) || (! in_array ( $_FILES ['photo'] ['type'], $imageTypes ))) {
		$imagePath = "";
		$error = true;
		echo "<span class='error'>Error uploading photo : " . $_FILES ["photo"] ["error"] . "<br />Allowed types are :jpg,png or gif<br/>Maximum size is 5MB</span>";
	} else {
		$imagePath = "../uploads/" . $_FILES ["photo"] ["name"];
		clearUploadsCache();
		move_uploaded_file ( $_FILES ["photo"] ["tmp_name"], $imagePath );
	}
	if (! $error) {
		$sql = "INSERT INTO `highlight` ( `id` , `link` , `photo` , `lang` )
				VALUES (NULL , '$link', '$imagePath' , '$hllang');";
		if (mysql_query ( $sql )) {
			echo "<script>document.location='highlights.php';</script>";
		} else {
			echo "<span class='error'>Failed to insert highlight</span>";
		}
	}
}

?>
<h2>New Highlight</h2>

<form action="<?=$_SERVER ['PHP_SELF']?>" method="post"
	enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Link</td>
		<td><input class="required" type="text" name="link" value="<?=stripslashes ( $link )?>" />
		<input type="hidden" name="id" value="<?=stripslashes ( $id )?>" /></td>
	</tr>
	<tr>
		<td>Photo</td>
		<td>
		<img src="<?=$imagePath?>" style="max-width: 200px;max-height: 300px"/><br />[W:H 960px:300px]<br/>
		<input type="file" class="required" name="photo" /></td>
	</tr>
	<tr>
		<td>Language</td>
		<td><?=createComboBox("Languages", "code", "language", $lang, "hllang","required")?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='highlights.php';" /></td>
	</tr>
</table>
</form>
<?php
include_once '../common/footer.php';
?>