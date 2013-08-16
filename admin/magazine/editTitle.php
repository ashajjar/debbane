<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];
$issue_id = $_REQUEST ['issue_id'];
$imageTypes=array('image/jpeg','image/png','image/gif');
$maxImageSize=300*1024;//300KB

if(isset($submit)){
	$error=false;
	$title_ar = addslashes($_POST['title_ar']);
	$brief_ar = addslashes($_POST['brief_ar']);
	$title_en = addslashes($_POST['title_en']);
	$brief_en = addslashes($_POST['brief_en']);
	
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
		$updatePDF="";
		if ($pdfPath!=""){
			$updatePDF=",pdf='$pdfPath' ";
		}
		$sql="UPDATE `magazinetitle` SET `title_ar`='$title_ar' , `brief_ar`='$brief_ar',`title_en`='$title_en' , `brief_en`='$brief_en' $updatePDF WHERE `id`='$id'";
		if(mysql_query($sql)){
			echo "<script>document.location='issueTitles.php?issue_id=$issue_id';</script>";
		}
		else{
			echo "<span class='error'>Failed to update issue title</span>";
		}
	}
}

$sql = "SELECT * FROM `magazinetitle` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit Category</h2>
<?
if ($rows > 0) {
	$title_ar = mysql_result ( $result, 0, "title_ar" );
	$brief_ar = mysql_result ( $result, 0, "brief_ar" );
	$title_en = mysql_result ( $result, 0, "title_en" );
	$brief_en = mysql_result ( $result, 0, "brief_en" );
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Title (ar)</td>
		<td><input type="text" class="required"  name="title_ar" value="<?=stripslashes($title_ar)?>" />
		<input type="hidden" name="id" value="<?=stripslashes($id)?>" />
		<input type="hidden" name="issue_id" value="<?=stripslashes($issue_id)?>" /></td>
	</tr>
	<tr>
		<td>Brief (ar)</td>
		<td><textarea rows="5" class="required"  cols="50" name="brief_ar"><?=stripslashes($brief_ar)?></textarea></td>
	</tr>
	<tr>
		<td>Title (en)</td>
		<td><input type="text" class="required"  name="title_en" value="<?=stripslashes($title_en)?>" /></td>
	</tr>
	<tr>
		<td>Brief (en)</td>
		<td><textarea rows="5" class="required"  cols="50" name="brief_en"><?=stripslashes($brief_en)?></textarea></td>
	</tr>
	<tr>
		<td>PDF</td>
		<td><input type="file" name="pdf" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit" value="Save"/>
		<input type="button" value="Back" onclick="document.location='issueTitles.php?issue_id=<?=$issue_id?>';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected issue title to be edited!";
}
include_once '../common/footer.php';
?>