<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `news` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('News was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to delete news!');</script>";
	}
}
$sql="SELECT * FROM `news` WHERE `lang`='$lang';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>News</h2>
<table width="100%">
	<tr>
		<td class="new"><a href="newNews.php">New</a></td>
		<td class="new" align="right"><?=createComboBox("Languages", "code", "language", $lang, "lang","","onchange=\"document.location='?lang='+this.value\";")?></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="100px">Title</th>
		<th width="400px">Brief</th>
		<th width="100px">Date</th>
		<th width="200px">Image</th>
		<th width="200px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$title=mysql_result($result, $i,"title");
		$brief=mysql_result($result, $i,"brief");
		$image=mysql_result($result, $i,"image");
		$date=mysql_result($result, $i,"date");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=stripslashes($title)?></td>
				<td valign="top">&nbsp;<?=shortText(stripslashes($brief),300)?>...</td>
				<td valign="top">&nbsp;<?=stripslashes($date)?></td>
				<td valign="top">
				<? if($image==""){?>
					&nbsp;
				<? } else {?>
					<img src="<?=$image?>" style="max-width: 150px;max-height: 200px"/>
				<? }?>
				</td>
				<td valign="top">
					<a href="editNews.php?id=<?=$id?>">Edit</a>&nbsp;|&nbsp;
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

