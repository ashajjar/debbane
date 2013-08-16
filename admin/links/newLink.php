<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST ['submit'];

if (isset ( $submit )) {
	$title = addslashes ( $_POST ['title'] );
	$link = addslashes($_POST['link']);
	$description = addslashes($_POST['description']);
	$linklang = addslashes($_POST['linklang']);
	
	$sql = "INSERT INTO `link` ( `id` , `title` , `link`,`description`,`lang` )
			VALUES (NULL , '$title', '$link','$description','$linklang');";
	if (mysql_query ( $sql )) {
		echo "<script>document.location='links.php';</script>";
	} else {
		echo "<span class='error'>Failed to insert link</span>";
	}
}

?>
<h2>New Link</h2>

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
			<input type="text" class="required" name="link" value="<?=stripslashes($link)?>" />
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
		<td><?=createComboBox("Languages", "code", "language", $lang, "linklang","required")?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='links.php';" /></td>
	</tr>
</table>
</form>
<?php
include_once '../common/footer.php';
?>