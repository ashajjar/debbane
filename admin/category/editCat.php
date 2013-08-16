<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];
$PID = $_REQUEST ['PID'];
$imageTypes=array('image/jpeg','image/png','image/gif');
$maxImageSize=300*1024;//300KB

if(isset($submit)){
	$error=false;
	$name = addslashes($_POST['name']);
	$description = addslashes($_POST['description']);
	$catlang = addslashes($_POST['catlang']);
	if (($_FILES ["image"] ["error"] > 0) || ($_FILES['image']['size']>$maxImageSize) || (!in_array($_FILES['image']['type'], $imageTypes))) {
		if($_FILES ["image"]["name"]!=""){
			$imagePath="";
			$error=true;
			echo "<span class='error'>Error uploading image : " . $_FILES ["image"] ["error"] . "<br />Allowed types are :jpg,png or gif<br/>Maximum size is 300KB</span>";
		}
	}
	else{
		clearUploadsCache();
		$imagePath="../uploads/".$_FILES ["image"]["name"];
		move_uploaded_file($_FILES ["image"]["tmp_name"], $imagePath);
	}
	
	if(!$error){
		$updateImage="";
		if ($imagePath!=""){
			$updateImage=",image='$imagePath' ";
		}
		$sql="UPDATE `category` SET `name`='$name' , `description`='$description' , `lang`='$catlang' $updateImage WHERE `id`='$id'";
		if(mysql_query($sql)){
			echo "<script>document.location='categories.php?PID=$PID';</script>";
		}
		else{
			echo "<span class='error'>Failed to update category</span>";
		}
	}
}

$sql = "SELECT * FROM `category` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit Category</h2>
<?
if ($rows > 0) {
	$name = mysql_result ( $result, 0, "name" );
	$description = mysql_result ( $result, 0, "description" );
	$image = mysql_result ( $result, 0, "image" );
	$catlang = mysql_result ( $result, 0, "lang" );
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Name</td>
		<td><input type="text" name="name" class="required" value="<?=stripslashes($name)?>" />
		<input type="hidden" name="id" value="<?=stripslashes($id)?>" />
		<input type="hidden" name="PID" value="<?=stripslashes($PID)?>" /></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><textarea rows="5" cols="50" class="required" name="description"><?=stripslashes($description)?></textarea></td>
	</tr>
	<tr>
		<td>Language</td>
		<td><?=createComboBox("Languages", "code", "language", $catlang, "catlang","required")?></td>
	</tr>
	<tr>
		<td>Image</td>
		<td>
		<img src="<?=$image?>" style="max-width: 200px;max-height: 300px"/><br/>[W:H 150px:200px]<br/>
		<input type="file" name="image"/></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit" value="Save"/>
		<input type="button" value="Back" onclick="document.location='categories.php?PID=<?=$PID?>';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected category to be edited!";
}
include_once '../common/footer.php';
?>