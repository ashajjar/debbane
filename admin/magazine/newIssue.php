<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];
//300KB;
$imageSize=300*1024;
//Images types 
$imageTypes=array('image/jpeg','image/png','image/gif');
if(isset($submit)){
	$error=false;
	$year = addslashes($_POST['year']);
	$month = addslashes($_POST['month']);

	if (($_FILES ["picture"] ["error"] > 0) || ($_FILES['picture']['size']>300*1024) || (!in_array($_FILES['picture']['type'], $imageTypes))) {
		$imagePath="";
		$error=true;
		echo "<span class='error'>Error uploading picture : " . $_FILES ["picture"] ["error"] . "<br />Allowed types are :pdf, jpg, png or gif<br/>Maximum size is 300KB</span>";
	}
	else{
		$imagePath="../uploads/".$_FILES ["picture"]["name"];
		clearUploadsCache();
		move_uploaded_file($_FILES ["picture"]["tmp_name"], $imagePath);
	}
	
	if (($_FILES ["pdf"] ["error"] > 0) || ($_FILES['pdf']['size']>300*1024) || ($_FILES['pdf']['type']!="application/pdf")) {
		$pdfPath="";
		$error=true;
		echo "<span class='error'>Error uploading pdf : " . $_FILES ["pdf"] ["error"] . "<br />Allowed types are :pdf, jpg, png or gif<br/>Maximum size is 300KB</span>";
	}
	else{
		$pdfPath="../uploads/".$_FILES ["pdf"]["name"];
		move_uploaded_file($_FILES ["pdf"]["tmp_name"], $pdfPath);
	}

	
	if (!$error){
		$sql="INSERT INTO `magazineissue` ( `id` , `year` , `month` ,`pdf`, `picture` )
				VALUES (NULL , '$year', '$month','$pdfPath', '$imagePath');";
		if(mysql_query($sql)){
			echo "<script>document.location='magazineIssues.php';</script>";
		}
		else{
			echo "<span class='error'>Failed to insert magazine issue</span>";
		}		
	}
}

?>
<h2>New Magazine Issue</h2>

<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Year</td>
		<td><input type="text" class="required numeric" name="year" value="<?=stripslashes($year)?>" />
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
		<input type="file" name="picture"  class="required" /></td>
	</tr>
	<tr>
		<td>PDF</td>
		<td>
		<input type="file" name="pdf"  class="required" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit" value="Save"/>
		<input type="button" value="Back" onclick="document.location='magazineIssues.php';" /></td>
	</tr>
</table>
</form>
<?php
include_once '../common/footer.php';
?>