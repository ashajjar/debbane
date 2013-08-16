<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `category` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('Category was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to delete category!');</script>";
	}
}
$PID=($_REQUEST['PID'])?$_REQUEST['PID']:0;

$sql="SELECT * FROM `category` WHERE PID='$PID' AND `lang`='$lang';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Categories</h2>
<table width="100%">
	<tr>
		<td class="new"><a href="newCat.php?PID=<?=$PID?>">New</a></td>
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
				<td valign="top">&nbsp;<?=stripslashes($description)?></td>
				<td valign="top">
				<? if($image==""){?>
					&nbsp;
				<? } else {?>
					<img src="<?=$image?>" style="max-width: 150px;max-height: 200px"/>
				<? }?>
				</td>
				<td valign="top">
					<a href="editCat.php?id=<?=$id?>&PID=<?=$PID?>">Edit</a>&nbsp;|&nbsp;
					<a class="deleteObject" href="<?=$_SERVER['PHP_SELF']?>?op=del&PID=<?=$PID?>&id=<?=$id?>">Delete</a>
					<? if (getCatLevel($id)<3){?>
					&nbsp;|&nbsp;
					<a href="categories.php?PID=<?=$id?>">Subcategories</a>
					<? }elseif(getCatLevel($id)==3){?>
					&nbsp;|&nbsp;
					<a href="products.php?catid=<?=$id?>">Products</a>
					<?}?>
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

