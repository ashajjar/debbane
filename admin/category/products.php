<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `product` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('Product was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to delete product!');</script>";
	}
}
$catid=$_REQUEST['catid'];
$sql="SELECT * FROM `product` WHERE `lang`='$lang' AND `cid`=$catid;";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Products</h2>
<table width="100%">
	<tr>
		<td class="new"><a href="newProduct.php?catid=<?=$catid?>">New</a></td>
		<td class="new" align="right"><?=createComboBox("Languages", "code", "language", $lang, "lang","","onchange=\"document.location='?lang='+this.value\";")?></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="100px">Name</th>
		<th width="500px">Description</th>
		<th width="200px">Image</th>
		<th width="200px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$name=mysql_result($result, $i,"name");
		$description=mysql_result($result, $i,"description");
		$image=mysql_result($result, $i,"image");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=stripslashes($name)?></td>
				<td valign="top">&nbsp;<?=shortText(stripslashes($description),200)?></td>
				<td valign="top">
				<? if($image==""){?>
					&nbsp;
				<? } else { ?>
					<img src="<?=$image?>" style="max-width: 150px;max-height: 200px"/>
				<? }?>
				</td>
				<td valign="top">
					<a href="editProduct.php?id=<?=$id?>">Edit</a>&nbsp;|&nbsp;
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

