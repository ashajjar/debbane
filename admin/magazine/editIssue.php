<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];

$imageTypes=array('image/jpeg','image/png','image/gif');
$maxImageSize=300*1024;//300KB

if(isset($submit)){
	$error=false;
	$year = addslashes($_POST['year']);
	$month = addslashes($_POST['month']);
	
	if (($_FILES ["picture"] ["error"] > 0) || ($_FILES['picture']['size']>$maxImageSize) || (!in_array($_FILES['picture']['type'], $imageTypes))) {
		if($_FILES ["picture"]["name"]!=""){
			$imagePath="";
			$error=true;
			echo "<span class='error'>Error uploading picture : " . $_FILES ["image"] ["error"] . "<br />Allowed types are :pdf, jpg, png or gif<br/>Maximum size is 300KB</span>";
		}
	}
	else{
		$imagePath="../uploads/".$_FILES ["picture"]["name"];
		clearUploadsCache();
		move_uploaded_file($_FILES ["picture"]["tmp_name"], $imagePath);
	}
	
	if (($_FILES ["pdf"] ["error"] > 0) || ($_FILES['pdf']['size']>300*1024) || ($_FILES['pdf']['type']!="application/pdf")) {
		if($_FILES ["pdf"]["name"]!=""){
			$pdfPath="";
			$error=true;
			echo "<span class='error'>Error uploading pdf : " . $_FILES ["pdf"] ["error"] . "<br />Allowed types are :pdf, jpg, png or gif<br/>Maximum size is 300KB</span>";
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
			$updateImage=",picture='$imagePath' ";
		}
		if ($pdfPath!=""){
			$updatePDF=",pdf='$pdfPath' ";
		}
		$sql="UPDATE `magazineissue` SET `year`='$year' , `month`='$month' $updatePDF $updateImage WHERE `id`='$id'";
		if(mysql_query($sql)){
			echo "<script>document.location='magazineIssues.php';</script>";
		}
		else{
			echo "<span class='error'>Failed to update magazine issue</span>";
		}
	}
}

$sql = "SELECT * FROM `magazineissue` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit Product</h2>
<?
if ($rows > 0) {
	$year=mysql_result($result, $i,"year");
	$month=mysql_result($result, $i,"month");
	$imagePath=mysql_result($result, $i,"picture");
	$pdf = mysql_result ( $result, 0, "pdf" );
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Year</td>
		<td><input type="text" name="year" class="required numeric" value="<?=stripslashes($year)?>" />
		<input type="hidden" name="id" value="<?=stripslashes($id)?>" /></td>
	</tr>
	<tr>
		<td>Month</td>
		<td><?=createMonthsCombobox($month, "month" ,"required")?></td>
	</tr>
	<tr>
		<td>Picture</td>
		<td>
		<img src="<?=$imagePath?>" style="max-width: 200px;max-height: 300px"/><br/>[W:H 150px:200px]<br/>
		<input type="file" name="picture" /></td>
	</tr>
	<tr>
		<td>PDF</td>
		<td>
		<input type="file" name="pdf" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit" value="Save"/>
		<input type="button" value="Back" onclick="document.location='magazineIssues.php';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected magazine issue to be edited!";
}
include_once '../common/footer.php';
?>