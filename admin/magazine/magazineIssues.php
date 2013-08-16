<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `magazineissue` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('Magazine issue was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to magazine issue category!');</script>";
	}
}

$sql="SELECT * FROM `magazineissue`";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Magazine Issues</h2>
<table>
	<tr>
		<td class="new"><a href="newIssue.php">New</a></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="250px">Year</th>
		<th width="250px">Month</th>
		<th width="250px">Picture</th>
		<th width="250px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$year=mysql_result($result, $i,"year");
		$month=mysql_result($result, $i,"month");
		$picture=mysql_result($result, $i,"picture");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=stripslashes($year)?></td>
				<td valign="top">&nbsp;<?=stripslashes(date("F",mktime(0,0,0,$month)))?></td>
				<td valign="top">
				<? if($picture==""){?>
					&nbsp;
				<? } else {?>
					<img src="<?=$picture?>" style="max-width: 150px;max-height: 200px"/>
				<? }?>
				</td>
				<td valign="top">
					<a href="editIssue.php?id=<?=$id?>">Edit</a>&nbsp;|&nbsp;
					<a class="deleteObject" href="<?=$_SERVER['PHP_SELF']?>?op=del&id=<?=$id?>">Delete</a>&nbsp;|&nbsp;
					<a href="issueTitles.php?issue_id=<?=$id?>">Issue's Titles</a>
				</td>
			</tr>
		<?php
		$i++;
	}
}
?>
</table>
<?php if ($PID!=0){?>
<div class="backButton"><input type="button" value="Back" onclick="document.location='categories.php?PID=<?=getParentCat($PID)?>'" /></div>
<?php }?>
<?php
include_once '../common/footer.php';
?>

