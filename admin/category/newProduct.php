<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];
$cid=$_GET['catid'];
//300KB;
$imageSize=300*1024;
//Images types 
$imageTypes=array('image/jpeg','image/png','image/gif');
if(isset($submit)){
	$error=false;
	$name = addslashes($_POST['name']);
	$description = addslashes($_POST['description']);
	$prolang = addslashes($_POST['prolang']);
	$cid=$_POST['cid'];
	$tmp=explode("-", $cid);
	$cid=trim($tmp[0]);

	if($_FILES ["image"] ["error"] != 4){
		if (($_FILES ["image"] ["error"] > 0) || ($_FILES['image']['size']>300*1024) || (!in_array($_FILES['image']['type'], $imageTypes))) {
			$imagePath="";
			$error=true;
			echo "<span class='error'>Error uploading image : " . $_FILES ["image"] ["error"] . "<br />Allowed types are :pdf, jpg, png or gif<br/>Maximum size is 300KB</span>";
		}
		else{
			$imagePath="../uploads/".$_FILES ["image"]["name"];
			clearUploadsCache();
			move_uploaded_file($_FILES ["image"]["tmp_name"], $imagePath);
		}
	}
	if($_FILES ["pdf"] ["error"] != 4){
		if ($_FILES ["pdf"] ["error"] > 0) {
			$pdfPath="";
			$error=true;
			echo "<span class='error'>Error uploading attachment : " . $_FILES ["pdf"] ["error"] . "</span>";
		}
		else{
			$pdfPath="../uploads/".$_FILES ["pdf"]["name"];
			move_uploaded_file($_FILES ["pdf"]["tmp_name"], $pdfPath);
		}
	}

	
	if (!$error){
		$sql="INSERT INTO `product` ( `id` , `name` , `description` ,`pdf`, `image` , `cid`,`lang` )
				VALUES (NULL , '$name', '$description','$pdfPath', '$imagePath', '$cid','$prolang');";
		if(mysql_query($sql)){
			echo "<script>document.location='products.php?catid=$cid';</script>";
		}
		else{
			echo "<span class='error'>Failed to insert product</span>";
		}		
	}
}

?>
<h2>New Product</h2>

<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Name</td>
		<td><input type="text" class="required" name="name" value="<?=stripslashes($name)?>" />
		<input type="hidden" name="id" value="<?=stripslashes($id)?>" /></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><textarea rows="5" cols="50" class="mceEditor required" name="description"><?=stripslashes($description)?></textarea></td>
	</tr>
	<tr>
		<td>Category</td>
		<?//=createComboBox("category", "id", "name", $cid, "cid")?>
		<td><input onfocus="this.click();" type="text" name="cid" class="__catSelectBtn __SelectedCatText required" value="<?=stripslashes($cid)." - ".getDataCell("name", "category", "id", $cid)?>" /></td>
	</tr>
	<tr>
		<td>Language</td>
		<td><?=createComboBox("Languages", "code", "language", $lang, "prolang","required")?></td>
	</tr>
	<tr>
		<td>Image</td>
		<td>
		<img src="<?=$image?>" style="max-width: 200px;max-height: 300px"/><br/>[W:H 300px:400px]<br/>
		<input type="file" name="image" class="required" /></td>
	</tr>
	<tr>
		<td>Attachment</td>
		<td>
		<input type="file" name="pdf" class="required" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit" value="Save"/>
		<input type="button" value="Back" onclick="document.location='products.php?catid=<?=$cid?>';" /></td>
	</tr>
</table>
</form>
<?php
include_once '../common/footer.php';
?>