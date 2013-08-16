<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `highlight` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('Highlight was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to delete highlight!');</script>";
	}
}

$sql="SELECT * FROM `highlight` WHERE `lang`='$lang';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Highlights</h2>
<table width="100%">
	<tr>
		<td class="new"><a href="newHL.php">New</a></td>
		<td class="new" align="right"><?=createComboBox("Languages", "code", "language", $lang, "lang","","onchange=\"document.location='?lang='+this.value\";")?></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="250px">Link</th>
		<th width="550px">Photo</th>
		<th width="200px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$link=mysql_result($result, $i,"link");
		$photo=mysql_result($result, $i,"photo");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=stripslashes($link)?></td>
				<td valign="top">
				<? if($photo==""){?>
					&nbsp;
				<? } else {?>
					<img src="<?=$photo?>" style="max-width: 150px;max-height: 200px"/>
				<? }?>
				</td>
				<td valign="top">
					<a href="editHL.php?id=<?=$id?>">Edit</a>&nbsp;|&nbsp;
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

