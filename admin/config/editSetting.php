<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];

if(isset($submit)){
	$value = addslashes($_POST["value"]);
	$sql="UPDATE `configuration` SET `value`='$value' WHERE `id`='$id' AND `lang`='$lang'";
	if(mysql_query($sql)){
		echo "<script>document.location='siteSettings.php';</script>";
	}
	else{
		echo "<span class='error'>Failed to update settings</span>";
	}
}

$sql = "SELECT * FROM `configuration` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit Setting</h2>
<?
if ($rows > 0) {
	$id=mysql_result($result, 0,"id");
	$key=mysql_result($result, 0,"key");
	$value=mysql_result($result, 0,"value");
	$type=mysql_result($result, 0,"type");
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="700px">
	<tr>
		<td>Key</td>
		<td><?=$key?><input type="hidden" name="id" value="<?=$id?>" /></td>
	</tr>
	<tr>
		<td>Value</td>
		<td>
			<textarea class="<?=($type=="html")?"mceEditor":""?> required" rows="5" cols="50" name="value"><?=stripslashes ( $value )?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit" value="Save"/>
		<input type="button" value="Back" onclick="document.location='siteSettings.php';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected setting to be edited!";
}
include_once '../common/footer.php';
?>