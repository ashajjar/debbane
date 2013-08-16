<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST ['submit'];
$PID = $_REQUEST ['PID'];
//300KB;
$imageSize = 300 * 1024;
//Images types
$imageTypes=array('image/jpeg','image/png','image/gif');
if (isset ( $submit )) {
	$error = false;
	$name = addslashes ( $_POST ['name'] );
	$description = addslashes ( $_POST ['description'] );
	$catlang = addslashes ( $_POST ['catlang'] );
	
	if (($_FILES ["image"] ["error"] > 0) || ($_FILES ['image'] ['size'] > 300 * 1024) || (! in_array ( $_FILES ['image'] ['type'], $imageTypes ))) {
		$imagePath = "";
		$error = true;
		echo "<span class='error'>Error uploading image : " . $_FILES ["image"] ["error"] . "<br />Allowed types are :jpg,png or gif<br/>Maximum size is 300KB</span>";
	} else {
		$imagePath = "../uploads/" . $_FILES ["image"] ["name"];
		clearUploadsCache();
		move_uploaded_file ( $_FILES ["image"] ["tmp_name"], $imagePath );
	}
	if (! $error) {
		$sql = "INSERT INTO `category` ( `id` , `name` , `description` , `image` , `PID` ,`lang` )
				VALUES (NULL , '$name', '$description', '$imagePath', '$PID', '$catlang');";
		if (mysql_query ( $sql )) {
			echo "<script>document.location='categories.php?PID=$PID';</script>";
		} else {
			echo "<span class='error'>Failed to insert category</span>";
		}
	}
}

?>
<h2>New Category</h2>

<form action="<?=$_SERVER ['PHP_SELF']?>" method="post"
	enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Name</td>
		<td><input type="text" name="name" class="required" value="<?=stripslashes ( $name )?>" />
		<input type="hidden" name="id" value="<?=stripslashes ( $id )?>" /> <input
			type="hidden" name="PID" value="<?=stripslashes ( $PID )?>" /></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><textarea rows="5" cols="50" name="description" class="required"><?=stripslashes ( $description )?></textarea></td>
	</tr>
	<tr>
		<td>Language</td>
		<td><?=createComboBox("Languages", "code", "language", $lang, "catlang","required")?></td>
	</tr>
	<tr>
		<td>Image</td>
		<td><img src="<?=$image?>" style="max-width: 200px;max-height: 300px"/><br />[W:H 150px:200px]<br/>
		<input type="file" name="image"  class="required"/></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='categories.php?PID=<?=$PID?>';" /></td>
	</tr>
</table>
</form>
<?php
include_once '../common/footer.php';
?>