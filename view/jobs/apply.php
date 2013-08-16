<?php
if($_REQUEST['ajax']){
	include_once '../../common/database.php';
	include_once '../includes/imaging.php';
	include_once '../includes/utils.php';
	include_once "../labels/labels_$lang.php";
	header('Content-Type: text/html; charset=Windows-1256');
}
else{
	include_once '../common/header.php';
	echo "<div class='innerContainer' style='display:inline'>";
}
?>
<h1 class="catTitle" style="width: 100%"><?=_ApplyToJob?></h1>
<?
$submit = $_POST ['submit'];
$offer_id = $_REQUEST ['id'];
//300KB;
$imageSize=300*1024;
//Images types 
$imageTypes=array('image/jpeg','image/png','image/gif');

$docTypes=array('image/jpeg','image/png','image/gif','application/pdf');
if (isset ( $submit )) {
	$fullName = addslashes ( $_POST ['fullName'] );
	$email = addslashes ( $_POST ['email'] );
	$phone = addslashes ( $_POST ['phone'] );
	$mobile = addslashes ( $_POST ['mobile'] );
	$error=false;
	if (($_FILES ["photo"] ["error"] > 0) || ($_FILES['photo']['size']>300*1024) || (!in_array($_FILES['photo']['type'], $imageTypes))) {
		$imagePath="";
		$error=true;
		echo "<p class='error'>Error uploading picture : " . $_FILES ["photo"] ["error"] . "<br />Allowed types are :jpg, png or gif<br/>Maximum size is 300KB</p>";
	}
	else{
		$imagePath="../../admin/uploads/".$_FILES ["photo"]["name"];
		clearUploadsCache();
		move_uploaded_file($_FILES ["photo"]["tmp_name"], $imagePath);
	}

	if($_FILES ["attachment1"]["name"]!=""){
		if (($_FILES ["attachment1"] ["error"] > 0) || ($_FILES['attachment1']['size']>300*1024) || (!in_array($_FILES['attachment1']['type'], $docTypes))) {
			$attachment1="";
			$error=true;
			echo "<p class='error'>Error uploading attachment1 : " . $_FILES ["attachment1"] ["error"] . "<br />Allowed types are :pdf, jpg, png or gif<br/>Maximum size is 300KB</p>";
		}
		else{
			$attachment1="../../admin/uploads/".$_FILES ["attachment1"]["name"];
			move_uploaded_file($_FILES ["attachment1"]["tmp_name"], $attachment1);
		}
	}
	

	if($_FILES ["attachment2"]["name"]!=""){
		if (($_FILES ["attachment2"] ["error"] > 0) || ($_FILES['attachment2']['size']>300*1024) || (!in_array($_FILES['attachment2']['type'], $docTypes))) {
			$attachment2="";
			$error=true;
			echo "<p class='error'>Error uploading attachment2 : " . $_FILES ["attachment2"] ["error"] . "<br />Allowed types are :pdf, jpg, png or gif<br/>Maximum size is 300KB</p>";
		}
		else{
			$attachment2="../../admin/uploads/".$_FILES ["attachment2"]["name"];
			move_uploaded_file($_FILES ["attachment2"]["tmp_name"], $attachment2);
		}
	}
	

	if($_FILES ["attachment3"]["name"]!=""){
		if (($_FILES ["attachment3"] ["error"] > 0) || ($_FILES['attachment3']['size']>300*1024) || (!in_array($_FILES['attachment3']['type'], $docTypes))) {
			$attachment3="";
			$error=true;
			echo "<p class='error'>Error uploading attachment3 : " . $_FILES ["attachment3"] ["error"] . "<br />Allowed types are :pdf, jpg, png or gif<br/>Maximum size is 300KB</p>";
		}
		else{
			$attachment3="../../admin/uploads/".$_FILES ["attachment3"]["name"];
			move_uploaded_file($_FILES ["attachment3"]["tmp_name"], $attachment3);
		}
	}
	if (!$error){
		$sql = "INSERT INTO `jobapplication` VALUES (NULL , '$fullName','$email','$phone','$imagePath','$attachment1','$attachment2','$attachment3','$offer_id');";
		if (mysql_query ( $sql )) {
			echo "<script>document.location='../';</script>";
		} else {
			echo "<span class='error'>"._ApplicationFailed."</span>";
		}
	}
}

?>

<table cellpadding="5" cellspacing="0" width="770px" align="center" border="0">
	<tr class="innerCategory">
		<td valign="top" align="center">
			<form class="ToBeValidated" action="<?=$_SERVER ['PHP_SELF']?>" method="post"
				enctype="multipart/form-data">
				<table align="center" width="770px">
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_FullName?></td>
						<td align="<?=mainDir?>"><input type="text" class="required" name="fullName" value="<?=stripslashes ( $fullName )?>" />
						<input type="hidden" name="id" value="<?=stripslashes ( $offer_id )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_EMail?></td>
						<td align="<?=mainDir?>"><input  class="required email" type="text" name="email" value="<?=stripslashes ( $email )?>" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Phone?></td>
						<td align="<?=mainDir?>"><input type="text" class="required" name="phone" value="<?=stripslashes ( $phone )?>" /></td>
					</tr>
					<!--<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Mobile?></td>
						<td align="<?=mainDir?>"><input type="text" class="required" name="mobile" value="<?=stripslashes ( $mobile )?>" /></td>
					</tr>
					--><tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_YourPhoto?></td>
						<td align="<?=mainDir?>"><input type="file" class="" name="photo" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Attach1?></td>
						<td align="<?=mainDir?>"><input type="file" name="attachment1" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Attach2?></td>
						<td align="<?=mainDir?>"><input type="file" name="attachment2" /></td>
					</tr>
					<tr>
						<td align="<?=reverseDir?>" class="formLabel"><?=_Attach3?></td>
						<td align="<?=mainDir?>"><input type="file" name="attachment3" /></td>
					</tr>

					<tr>
						<td colspan="2" align="center"><input style="font-size: 11px;" type="submit" name="submit" value="<?=_Apply?>" /></td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<?php 
if($_REQUEST['ajax']){

}
else{
	echo "</div>";
	include_once '../common/footer.php';
}
?>