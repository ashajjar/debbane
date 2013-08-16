<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST ['submit'];
if (isset ( $submit )) {
	$question = addslashes ( $_POST ['question'] );
	$answer = addslashes($_POST['answer']);
	$isActive = addslashes($_POST['isActive']);
	$faqlang = addslashes($_POST['faqlang']);
	
	$sql = "INSERT INTO `faq` ( `id` , `question` , `answer`,`isActive` , `lang`)
			VALUES (NULL , '$question', '$answer','$isActive','$faqlang');";
	if (mysql_query ( $sql )) {
		echo "<script>document.location='faqs.php';</script>";
	} else {
		echo "<span class='error'>Failed to insert FAQ</span>";
	}
}

?>
<h2>New FAQ</h2>

<form action="<?=$_SERVER ['PHP_SELF']?>" method="post">
<table align="center" width="700px">
	<tr>
		<td>Question</td>
		<td><textarea class=" required" rows="5" cols="50" name="question"><?=stripslashes ( $question )?></textarea>
		<input type="hidden" name="id" value="<?=stripslashes ( $id )?>" /></td>
	</tr>
	<tr>
		<td>Answer</td>
		<td>
			<textarea class=" required" rows="5" cols="50" name="answer"><?=stripslashes ( $answer )?></textarea>
		</td>
	</tr>
	<tr>
		<td>Active ?</td>
		<td>
			<input type="checkbox" name="isActive" value="1" checked="checked" />
		</td>
	</tr>
	<tr>
		<td>Language</td>
		<td><?=createComboBox("Languages", "code", "language", $lang, "faqlang","required")?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='faqs.php';" /></td>
	</tr>
</table>
</form>
<?php
include_once '../common/footer.php';
?>