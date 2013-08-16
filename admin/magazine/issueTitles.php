<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `magazinetitle` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('Magazine title was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to delete magazine title!');</script>";
	}
}
$issue_id=($_REQUEST['issue_id'])?$_REQUEST['issue_id']:0;

$sql="SELECT * FROM `magazinetitle` WHERE `issue_id`='$issue_id';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Issue Titles</h2>
<table>
	<tr>
		<td class="new"><a href="newTitle.php?issue_id=<?=$issue_id?>">New</a></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="400px">Title (en)</th>
		<th width="400px">Title (ar)</th>
		<th width="200px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$title_en=mysql_result($result, $i,"title_en");
		$title_ar=mysql_result($result, $i,"title_ar");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=stripslashes($title_en)?></td>
				<td valign="top">&nbsp;<?=stripslashes($title_ar)?></td>
				<td valign="top">
					<a href="editTitle.php?id=<?=$id?>&issue_id=<?=$issue_id?>">Edit</a>&nbsp;|&nbsp;
					<a class="deleteObject" href="<?=$_SERVER['PHP_SELF']?>?op=del&issue_id=<?=$issue_id?>&id=<?=$id?>">Delete</a>
				</td>
			</tr>
		<?php
		$i++;
	}
}
?>
</table>
<div class="backButton"><input type="button" value="Back" onclick="document.location='magazineIssues.php'" /></div>
<?php
include_once '../common/footer.php';
?>

