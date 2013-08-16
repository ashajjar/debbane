<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `newsletter` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('Subscriber was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to delete subscriber!');</script>";
	}
}
$sql="SELECT * FROM `newsletter`;";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Newsletter Subscribers</h2>
<table>
	<tr>
		<td class="new">
			<form action="../includes/export.php" method="post">
				<input type="hidden" name="SQL" value="<?=$sql?>"/>
				<input type="hidden" name="outputFilename" value="<?="Subscribers-".date("d-F-Y").".xls"?>"/>
				<input type="submit" name="submit" value="Export" style="border: 0;background-color: #fff"/>|&nbsp;
				<a href="newSubscriber.php">New</a>&nbsp;|&nbsp;<a href="sendNewsletter.php">Send Newsletter</a>
			</form>
		</td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="200px">Name</th>
		<th width="400px">E-Mail</th>
		<th width="200px">Active ?</th>
		<th width="200px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$name=mysql_result($result, $i,"name");
		$email=mysql_result($result, $i,"email");
		$isActive=mysql_result($result, $i,"isActive");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=stripslashes($name)?></td>
				<td valign="top">&nbsp;<?=stripslashes($email)?></td>
				<td valign="top">&nbsp;<?=($isActive)?"Yes":"No"?></td>
				<td valign="top">
					<a href="editSubscriber.php?id=<?=$id?>">Edit</a>&nbsp;|&nbsp;
					<a class="deleteObject" href="<?=$_SERVER['PHP_SELF']?>?op=del&id=<?=$id?>">Delete</a>
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

