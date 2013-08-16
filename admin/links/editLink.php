<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];

if(isset($submit)){
	$title = addslashes ( $_POST ['title'] );
	$link = addslashes($_POST['link']);
	$description = addslashes($_POST['description']);
	$linklang = addslashes($_POST['linklang']);
	
	$sql="UPDATE `link` SET `title`='$title',`link`='$link',`description`='$description', `lang`='$linklang' WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>document.location='links.php';</script>";
	}
	else{
		echo "<span class='error'>Failed to update link</span>";
	}
}

$sql = "SELECT * FROM `link` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit Highlight</h2>
<?
if ($rows > 0) {
	$id=mysql_result($result, 0,"id");
	$title=mysql_result($result, 0,"title");
	$link=mysql_result($result, 0,"link");
	$description=mysql_result($result, 0,"description");
	$linklang=mysql_result($result, 0,"lang");
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post">
<table align="center" width="700px">
	<tr>
		<td>Title</td>
		<td><input type="text" class="required" name="title" value="<?=stripslashes($title)?>" />
		<input type="hidden" name="id" value="<?=stripslashes ( $id )?>" /></td>
	</tr>
	<tr>
		<td>Link</td>
		<td>
			<input type="text" name="link" class="required" value="<?=stripslashes($link)?>" />
		</td>
	</tr>
	<tr>
		<td>Description</td>
		<td>
			<textarea class="required" rows="5" cols="50" name="description"><?=stripslashes ( $description )?></textarea>
		</td>
	</tr>
	<tr>
		<td>Language</td>
		<td><?=createComboBox("Languages", "code", "language", $linklang, "linklang","required")?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='links.php';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected link to be edited!";
}
include_once '../common/footer.php';
?>