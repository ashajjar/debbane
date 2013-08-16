<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `faq` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('FAQ was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to delete FAQ!');</script>";
	}
}

$sql="SELECT * FROM `faq` WHERE `lang`='$lang';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>FAQs</h2>
<table width="100%">
	<tr>
		<td class="new"><a href="newFaq.php">New</a></td>
		<td class="new" align="right"><?=createComboBox("Languages", "code", "language", $lang, "lang","","onchange=\"document.location='?lang='+this.value\";")?></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="500px">Question</th>
		<th width="400px">Is Active</th>
		<th width="200px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$question=mysql_result($result, $i,"question");
		$answer=mysql_result($result, $i,"answer");
		$isActive=mysql_result($result, $i,"isActive");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=strip_tags(stripslashes($question))?></td>
				<td valign="top">&nbsp;<?=stripslashes($isActive)?"Yes":"No"?></td>
				<td valign="top">
					<a href="editFaq.php?id=<?=$id?>">Edit</a>&nbsp;|&nbsp;
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

