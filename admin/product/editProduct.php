<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];

$imageTypes=array('image/jpeg','image/png','image/gif');
$maxImageSize=300*1024;//300KB

if(isset($submit)){
	$error=false;
	$name = addslashes($_POST['name']);
	$description = addslashes($_POST['description']);
	$prolang = addslashes($_POST['prolang']);
	$cid=$_POST['cid'];
	$tmp=explode("-", $cid);
	$cid=trim($tmp[0]);
	
	if (($_FILES ["image"] ["error"] > 0) || ($_FILES['image']['size']>$maxImageSize) || (!in_array($_FILES['image']['type'], $imageTypes))) {
		if($_FILES ["image"]["name"]!=""){
			$imagePath="";
			$error=true;
			echo "<span class='error'>Error uploading image : " . $_FILES ["image"] ["error"] . "<br />Allowed types are :pdf, jpg, png or gif<br/>Maximum size is 300KB</span>";
		}
	}
	else{
		$imagePath="../uploads/".$_FILES ["image"]["name"];
		clearUploadsCache();
		move_uploaded_file($_FILES ["image"]["tmp_name"], $imagePath);
	}
	
	if ($_FILES ["pdf"] ["error"] > 0){
		if($_FILES ["pdf"]["name"]!=""){
			$pdfPath="";
			$error=true;
			echo "<span class='error'>Error uploading attachment : " . $_FILES ["pdf"] ["error"] . "</span>";
		}
	}
	else{
		$pdfPath="../uploads/".$_FILES ["pdf"]["name"];
		move_uploaded_file($_FILES ["pdf"]["tmp_name"], $pdfPath);
	}
	
	if(!$error){
		$updateImage="";
		$updatePDF="";
		if ($imagePath!=""){
			$updateImage=",image='$imagePath' ";
		}
		if ($pdfPath!=""){
			$updatePDF=",pdf='$pdfPath' ";
		}
		$sql="UPDATE `product` SET `name`='$name' , `description`='$description',cid='$cid',`lang`='$prolang' $updatePDF $updateImage WHERE `id`='$id'";
		if(mysql_query($sql)){
			echo "<script>document.location='products.php';</script>";
		}
		else{
			echo "<span class='error'>Failed to update product</span>";
		}
	}
}

$sql = "SELECT * FROM `product` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit Product</h2>
<?
if ($rows > 0) {
	$name = mysql_result ( $result, 0, "name" );
	$description = mysql_result ( $result, 0, "description" );
	$image = mysql_result ( $result, 0, "image" );
	$pdf = mysql_result ( $result, 0, "pdf" );
	$cid = mysql_result ( $result, 0, "cid" );
	$prolang =mysql_result ( $result, 0, "lang" );
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Name</td>
		<td><input class="required" type="text" name="name" value="<?=stripslashes($name)?>" />
		<input type="hidden" name="id" value="<?=stripslashes($id)?>" /></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><textarea rows="5" cols="50" class="mceEditor required" name="description"><?=stripslashes($description)?></textarea></td>
	</tr>
	<tr>
		<td>Category</td>
		<?//=createComboBox("category", "id", "name", $cid, "cid")?>
		<td><input onfocus="this.click();" type="text" name="cid" class="__catSelectBtn required __SelectedCatText" value="<?=stripslashes($cid)." - ".getDataCell("name", "category", "id", $cid)?>" /></td>
	</tr>
		<tr>
		<td>Language</td>
		<td><?=createComboBox("Languages", "code", "language", $prolang, "prolang","required")?></td>
	</tr>
	<tr>
		<td>Image</td>
		<td>
		<img src="<?=$image?>" style="max-width: 200px;max-height: 300px"/><br/>[W:H 300px:400px]<br/>
		<input type="file" name="image" /></td>
	</tr>
	<tr>
		<td>Attachment</td>
		<td>
		<input type="file" name="pdf" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit" value="Save"/>
		<input type="button" value="Back" onclick="document.location='products.php';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected product to be edited!";
}
include_once '../common/footer.php';
?>