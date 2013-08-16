<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `joboffer` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('Job offer was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to delete job offer!');</script>";
	}
}
$sql="SELECT * FROM `joboffer` WHERE `lang`='$lang';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Job Offers</h2>
<table width="100%">
	<tr>
		<td class="new"><a href="newJob.php">New</a></td>
		<td class="new" align="right"><?=createComboBox("Languages", "code", "language", $lang, "lang","","onchange=\"document.location='?lang='+this.value\";")?></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="300px">Title</th>
		<th width="200px">Job Code</th>
		<th width="300px">Department</th>
		<th width="200px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$title=mysql_result($result, $i,"title");
		$jobCode=mysql_result($result, $i,"jobCode");
		$department=mysql_result($result, $i,"department");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=stripslashes($title)?></td>
				<td valign="top">&nbsp;<?=stripslashes($jobCode)?></td>
				<td valign="top">&nbsp;<?=stripslashes($department)?></td>
				<td valign="top">
					<a href="candidates.php?id=<?=$id?>">Candidates</a>&nbsp;|&nbsp;
					<a href="editJob.php?id=<?=$id?>">Edit</a>&nbsp;|&nbsp;
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