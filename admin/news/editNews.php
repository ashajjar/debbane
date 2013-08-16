<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];

$imageTypes=array('image/jpeg','image/png','image/gif');
$maxImageSize=5*1024*1024;//5MB

if(isset($submit)){
	$error=false;
	$title = addslashes ( $_POST ['title'] );
	$brief = addslashes ( $_POST ['brief'] );
	$details = addslashes ( $_POST ['details'] );
	$date = addslashes ( $_POST ['date'] );
	$newslang = addslashes ( $_POST ['newslang'] );
	
	if (($_FILES ["image"] ["error"] > 0) || ($_FILES['image']['size']>$maxImageSize) || (!in_array($_FILES['image']['type'], $imageTypes))) {
		if($_FILES ["image"]["name"]!=""){
			$imagePath="";
			$error=true;
			echo "<span class='error'>Error uploading image : " . $_FILES ["image"] ["error"] . "<br />Allowed types are :jpg,png or gif<br/>Maximum size is 5MB</span>";
		}
	}
	else{
		$imagePath="../uploads/".$_FILES ["image"]["name"];
		clearUploadsCache();
		move_uploaded_file($_FILES ["image"]["tmp_name"], $imagePath);
	}
	
	if(!$error){
		$updateImage="";
		if ($imagePath!=""){
			$updateImage=",image='$imagePath' ";
		}
		$sql="UPDATE `news` SET `title`='$title' , `brief`='$brief', `details`='$details', `date`='$date',`lang`='$newslang' $updateImage WHERE `id`='$id'";
		if(mysql_query($sql)){
			echo "<script>document.location='news.php';</script>";
		}
		else{
			echo "<span class='error'>Failed to update news</span>";
		}
	}
}

$sql = "SELECT * FROM `news` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit News</h2>
<?
if ($rows > 0) {
		$title=mysql_result($result, 0,"title");
		$brief=mysql_result($result, 0,"brief");
		$details=mysql_result($result, 0,"details");
		$imagePath=mysql_result($result, 0,"image");
		$date=mysql_result($result, 0,"date");
		$newslang=mysql_result($result, 0,"lang");
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Title</td>
		<td><input type="text" class="required" name="title" value="<?=stripslashes ( $title )?>" />
		<input type="hidden" name="id" value="<?=stripslashes ( $id )?>" /></td>
	</tr>
	<tr>
		<td>Brief</td>
		<td><textarea rows="5" cols="50" class="required" name="brief"><?=stripslashes ( $brief )?></textarea></td>
	</tr>
	<tr>
		<td>Details</td>
		<td><textarea class="mceEditor required" rows="5" cols="50" name="details"><?=stripslashes ( $details )?></textarea></td>
	</tr>
	<tr>
		<td>Date</td>
		<td><input type="text" name="date" class="required dateF" value="<?=stripslashes ( $date )?>" /></td>
	</tr>
	<tr>
		<td>Language</td>
		<td><?=createComboBox("Languages", "code", "language", $newslang, "newslang","required")?></td>
	</tr>
	<tr>
		<td>Image</td>
		<td><img src="<?=$imagePath?>" style="max-width: 200px;max-height: 300px"/><br />[W:H 300px:400px]<br/>
		<input type="file" name="image" class=""/></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='news.php';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected category to be edited!";
}
include_once '../common/footer.php';
?>