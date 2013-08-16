<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];
$imageTypes=array('image/jpeg','image/png','image/gif');
$maxImageSize = 5 * 1024 * 1024;//5MB

if(isset($submit)){
	$error=false;
	$link = addslashes($_POST['link']);
	$hllang = addslashes($_POST['hllang']);
	
	if (($_FILES ["photo"] ["error"] > 0) || ($_FILES['photo']['size']>$maxImageSize) || (!in_array($_FILES['photo']['type'], $imageTypes))) {
		if($_FILES ["photo"]["name"]!=""){
			$imagePath="";
			$error=true;
			echo "<span class='error'>Error uploading photo : " . $_FILES ["photo"] ["error"] . "<br />Allowed types are :jpg,png or gif<br/>Maximum size is 5MB</span>";
		}
	}
	else{
		$imagePath="../uploads/".$_FILES ["photo"]["name"];
		clearUploadsCache();
		move_uploaded_file($_FILES ["photo"]["tmp_name"], $imagePath);
	}
	
	if(!$error){
		$updateImage="";
		if ($imagePath!=""){
			$updateImage=",photo='$imagePath' ";
		}
		$sql="UPDATE `highlight` SET `link`='$link',`lang`='$hllang' $updateImage WHERE `id`='$id'";
		if(mysql_query($sql)){
			echo "<script>document.location='highlights.php';</script>";
		}
		else{
			echo "<span class='error'>Failed to update highlight</span>";
		}
	}
}

$sql = "SELECT * FROM `highlight` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit Highlight</h2>
<?
if ($rows > 0) {
	$link = mysql_result ( $result, 0, "link" );
	$photo = mysql_result ( $result, 0, "photo" );
	$hllang = mysql_result ( $result, 0, "lang" );
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post"
	enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Link</td>
		<td><input class="required" type="text" name="link" value="<?=stripslashes($link)?>" />
		<input type="hidden" name="id" value="<?=stripslashes($id)?>" /></td>
	</tr>
	<tr>
		<td>Photo</td>
		<td><img src="<?=$photo?>" style="max-width: 200px;max-height: 300px"/><br />[W:H 960px:300px]<br/>
		<input type="file" name="photo" /></td>
	</tr>
	<tr>
		<td>Language</td>
		<td><?=createComboBox("Languages", "code", "language", $hllang, "hllang","required")?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='highlights.php';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected highlight to be edited!";
}
include_once '../common/footer.php';
?>