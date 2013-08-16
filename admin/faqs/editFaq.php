<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];

if(isset($submit)){
	$question = addslashes ( $_POST ['question'] );
	$answer = addslashes($_POST['answer']);
	$isActive = addslashes($_POST['isActive']);
	$faqlang = addslashes($_POST['faqlang']);
	
	$sql="UPDATE `faq` SET `question`='$question',`answer`='$answer',`isActive`='$isActive',`lang`='$faqlang' WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>document.location='faqs.php';</script>";
	}
	else{
		echo "<span class='error'>Failed to update FAQs</span>";
	}
}

$sql = "SELECT * FROM `faq` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit Highlight</h2>
<?
if ($rows > 0) {
	$id=mysql_result($result, 0,"id");
	$question=mysql_result($result, 0,"question");
	$answer=mysql_result($result, 0,"answer");
	$isActive=mysql_result($result, 0,"isActive");
	$faqlang=mysql_result($result, 0,"lang");
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post">
<table align="center" width="700px">
	<tr>
		<td>Question</td>
		<td><textarea class="required" rows="5" cols="50" name="question"><?=stripslashes ( $question )?></textarea>
		<input type="hidden" name="id" value="<?=stripslashes ( $id )?>" /></td>
	</tr>
	<tr>
		<td>Answer</td>
		<td>
			<textarea class="required" rows="5" cols="50" name="answer"><?=stripslashes ( $answer )?></textarea>
		</td>
	</tr>
	<tr>
		<td>Active ?</td>
		<td>
			<input type="checkbox" name="isActive" value="1" <?=($isActive)?"checked='checked'":""?> />
		</td>
	</tr>
	<tr>
		<td>Language</td>
		<td><?=createComboBox("Languages", "code", "language", $faqlang, "faqlang","required")?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Save" /> <input type="button" value="Back"
			onclick="document.location='faqs.php';" /></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected FAQ to be edited!";
}
include_once '../common/footer.php';
?>