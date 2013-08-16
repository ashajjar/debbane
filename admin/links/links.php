<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `link` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('Link was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to delete link!');</script>";
	}
}

$sql="SELECT * FROM `link` WHERE `lang`='$lang';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Links</h2>
<table width="100%">
	<tr>
		<td class="new"><a href="newLink.php">New</a></td>
		<td class="new" align="right"><?=createComboBox("Languages", "code", "language", $lang, "lang","","onchange=\"document.location='?lang='+this.value\";")?></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="500px">Title</th>
		<th width="400px">Link</th>
		<th width="200px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$title=mysql_result($result, $i,"title");
		$link=mysql_result($result, $i,"link");
		$description=mysql_result($result, $i,"description");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=strip_tags(stripslashes($title))?></td>
				<td valign="top">&nbsp;<?=stripslashes($link)?></td>
				<td valign="top">
					<a href="editLink.php?id=<?=$id?>">Edit</a>&nbsp;|&nbsp;
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