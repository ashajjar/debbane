<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `message` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('Message was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to delete message!');</script>";
	}
}
$sql="SELECT * FROM `message` ORDER BY `isRead` DESC;";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Contact us - Messages</h2>
<table>
	<tr>
		<td class="new">
			<form action="../includes/export.php" method="post">
				<input type="hidden" name="SQL" value="<?=$sql?>"/>
				<input type="hidden" name="outputFilename" value="<?="Mesages-".date("d-F-Y").".xls"?>"/>
				<input type="submit" name="submit" value="Export" style="border: 0;background-color: #fff"/>
			</form>
		</td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="150px">Name</th>
		<th width="250px">E-Mail</th>
		<th width="200px">Subject</th>
		<th width="200px">Date</th>
		<th width="50px">Read?</th>
		<th width="50px">Replied?</th>
		<th width="100px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$name=mysql_result($result, $i,"name");
		$email=mysql_result($result, $i,"email");
		$subject=mysql_result($result, $i,"subject");
		$date=mysql_result($result, $i,"date");
		$isRead=mysql_result($result, $i,"isRead");
		$isReplied=mysql_result($result, $i,"isReplied");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=stripslashes($name)?></td>
				<td valign="top">&nbsp;<?=stripslashes($email)?></td>
				<td valign="top">&nbsp;<?=stripslashes($subject)?></td>
				<td valign="top">&nbsp;<?=stripslashes($date)?></td>
				<td valign="top">&nbsp;<?=($isRead)?"Yes":"No"?></td>
				<td valign="top">&nbsp;<?=($isReplied)?"Yes":"No"?></td>
				<td valign="top">
					<a href="viewMessage.php?id=<?=$id?>">View & Reply</a>
				</td>
			</tr>
		<?php
		$i++;
	}
}
?>
</table>
<?php
include_once '../common/footer.php';
?>

