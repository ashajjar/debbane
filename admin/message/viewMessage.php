<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];

if(isset($submit)){
	$from="ahmed_hajjar@hotmail.com";
	$subject="Re:".$_POST['subject'];
	$to=$_POST['to'];
	$reply=$_POST['reply'];
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "To:".$to."\r\n";
	$headers .= "From: ".$from." \r\n";
	
	$s = @mail($to, $subject, $reply, $headers);
	if($s){
		mysql_query ( "UPDATE `message` SET `isReplied`=1 WHERE `id`='$id'" );
		echo "<script>document.location='messages.php';</script>";
	}
	else{
		echo "<span class='error'>Failed to reply message</span>";
	}
}

$sql = "SELECT * FROM `message` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
?>
<h2>Edit News</h2>
<?
if ($rows > 0) {
		$message=mysql_result($result, 0,"message");
		$name=mysql_result($result, 0,"name");
		$email=mysql_result($result, 0,"email");
		$subject=mysql_result($result, 0,"subject");
		$date=mysql_result($result, 0,"date");
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<table align="center" width="700px">
	<tr>
		<td>From : </td>
		<td><?=$name." &lt;".$email."&gt;"?>
		<input type="hidden" name="to" value="<?=$name." <".$email.">"?>"/></td>
	</tr>
	<tr>
		<td>On :</td>
		<td><?=$date?></td>
	</tr>
	<tr>
		<td>Subject :</td>
		<td><?=$subject?>
		<input type="hidden" name="subject" value="<?=$subject?>"/></td>
	</tr>
	<tr>
		<td>Message : </td>
		<td><?=$message?></td>
	</tr>
	
	<tr>
		<td>Reply : </td>
		<td><textarea rows="5" cols="50" class="mceEditor required" name="reply"><?=stripslashes ( $reply )?></textarea></td>
	</tr>
	
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Reply" /> <input type="button" value="Back"
			onclick="document.location='messages.php';" /></td>
	</tr>
</table>
</form>
<?php
	mysql_query ( "UPDATE `message` SET `isRead`=1 WHERE `id`='$id'" );
}else{
	echo "No selected message to be viewed!";
}
include_once '../common/footer.php';
?>