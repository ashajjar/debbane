<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST ['submit'];

if (isset ( $submit )) {
	$title = addslashes ( $_POST ['title'] );
	$jobCode = addslashes ( $_POST ['jobCode'] );
	$department = addslashes ( $_POST ['department'] );
	$responsibilities = addslashes ( $_POST ['responsibilities'] );
	$qualifications = addslashes ( $_POST ['qualifications'] );
	$joblang = addslashes ( $_POST ['joblang'] );
	
	$sql = "INSERT INTO `joboffer` VALUES (NULL , '$title', '$jobCode', '$department', '$responsibilities','$qualifications','$joblang');";
	if (mysql_query ( $sql )) {
		echo "<script>document.location='jobs.php';</script>";
	} else {
		echo "<span class='error'>Failed to insert job offer</span>";
	}
}

?>
<h2>New Job Offer</h2>

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
		<td><input type="text" class="required" name="department" value="<?=stripslashes ( $department )?>" /></td>
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
		<td><?=createComboBox("Languages", "code", "language", $lang, "joblang","required")?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='jobs.php';" /></td>
	</tr>
</table>
</form>
<?php
include_once '../common/footer.php';
?>