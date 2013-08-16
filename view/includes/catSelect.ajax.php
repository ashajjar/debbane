<?php
include_once '../common/security.php';
include_once '../../common/database.php';
include_once '../includes/imaging.php';
include_once '../includes/utils.php';
include_once "../labels/labels_$lang.php";

$parentCat=($_REQUEST['parentCat']=="")?"0":$_REQUEST['parentCat'];
$parentCat=($_REQUEST['selected']=="")?$parentCat:getParentCat($_REQUEST['selected']);

$sql="SELECT * FROM `category` WHERE `PID`='$parentCat' AND (id in (select PID from category));";
$result=mysql_query($sql);
$numRows=mysql_num_rows($result);
echo "<span class='__H_Six'>".getCatPath($parentCat)."</span>";
?>

<div class='__list'>
	<?php if($parentCat!="0"){?>
	<div class="__branch" id="cat_<?=getParentCat($parentCat)?>">[Go Back]</div>
	<?php }?>
<?
if($numRows>0)
{
	$i=0;
	while ($i<$numRows)
	{
		$cat_id=mysql_result($result, $i,"id");
		$cat_name=mysql_result($result, $i,"name");
		?>
			<div class="__branch" id="cat_<?=$cat_id?>"><?=$cat_name?></div>
		<?
		$i++;
	}
}

$sql="SELECT * FROM `category` WHERE `PID`='$parentCat' AND (id not in (select PID from category));";
$result=mysql_query($sql);
$numRows=mysql_num_rows($result);
if($numRows>0)
{
	$i=0;
	while ($i<$numRows)
	{
		$cat_id=mysql_result($result, $i,"id");
		$cat_name=mysql_result($result, $i,"name");
		?>
			<div class="__leaf" id="cat_<?=$cat_id?>"><?=$cat_name?></div>
		<?
		$i++;
	}
}
else 
{
	echo "No categories !";
}
?>
</div>
<input type="button" value="Cancel" />
<div class="__help">
Double-click the entry to open it or to select it
</div>
<?php 
function getCatPath($cat_id){
	if($cat_id==0){
		return "You are in : Root > ";
	}
	else{
		return getCatPath(getParentCat($cat_id)).getDataCell("name" ,"category", "id", $cat_id)." > ";
	}
}

?>







