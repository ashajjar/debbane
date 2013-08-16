<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];

if(isset($submit)){
	$title = addslashes ( $_POST ['title'] );
	$jobCode = addslashes ( $_POST ['jobCode'] );
	$department = addslashes ( $_POST ['department'] );
	$responsibilities = addslashes ( $_POST ['responsibilities'] );
	$qualifications = addslashes ( $_POST ['qualifications'] );
	$joblang = addslashes ( $_POST ['joblang'] );

	$sql="UPDATE `joboffer` SET `title`='$title' , `jobCode`='$jobCode', `department`='$department', `responsibilities`='$responsibilities',`qualifications`='$qualifications',`lang`='$joblang' WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>document.location='jobs.php';</script>";
	}
	else{
		echo "<span class='error'>Failed to update job offer</span>";
	}
}

$sql = "SELECT * FROM `joboffer` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit Job</h2>
<?
if ($rows > 0) {
		$title=mysql_result($result, 0,"title");
		$jobCode=mysql_result($result, 0,"jobCode");
		$department=mysql_result($result, 0,"department");
		$responsibilities=mysql_result($result, 0,"responsibilities");
		$qualifications=mysql_result($result, 0,"qualifications");
		$joblang=mysql_result($result, 0,"lang");
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post"
	enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Title</td>
		<td><input type="text" class="required" name="title" value="<?=stripslashes ( $title )?>" />
		<input type="hidden" name="id" value="<?=stripslashes ( $id )?>" /></td>
	</tr>
	<tr>
		<td>Job Code</td>
		<td><input type="text" class="required" name="jobCode" value="<?=stripslashes ( $jobCode )?>" /></td>
	</tr>
	<tr>
		<td>Department</td>
		<td><input type="text" name="department" class="required" value="<?=stripslashes ( $department )?>" /></td>
	</tr>
	<tr>
		<td>Responsibilities</td>
		<td><textarea class="mceEditor required" rows="5" cols="50" name="responsibilities"><?=stripslashes ( $responsibilities )?></textarea></td>
	</tr>
	<tr>
		<td>Qualifications</td>
		<td><textarea class="mceEditor required" rows="5" cols="50" name="qualifications"><?=stripslashes ( $qualifications )?></textarea></td>
	</tr>
	<tr>
		<td>Language</td>
		<td><?=createComboBox("Languages", "code", "language", $joblang, "joblang","required")?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='jobs.php';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected category to be edited!";
}
include_once '../common/footer.php';
?>