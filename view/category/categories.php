<?php
if($_REQUEST['ajax']){
	include_once '../../common/database.php';
	include_once '../includes/imaging.php';
	include_once '../includes/utils.php';
	include_once "../labels/labels_$lang.php";
	header('Content-Type: text/html; charset=Windows-1256');
}
else{
	include_once '../common/header.php';
	echo "<div class='innerContainer' style='display:inline'>";
}

$PID=($_REQUEST['PID'])?$_REQUEST['PID']:0;

$sql="SELECT * FROM `category` WHERE PID='$PID' AND `lang`='$lang';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h1 class="catTitle"><?=Categories?></h1>

<table cellpadding="5" cellspacing="0" width="770px" align="center" border="0">
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$name=mysql_result($result, $i,"name");
		$description=mysql_result($result, $i,"description");
		$image=mysql_result($result, $i,"image");
		
		$level=getCatLevel($id);
		if($level>=3){
			$goto="../product/products.php?cid=$id";
		}
		else{
			$goto=$_SERVER['PHP_SELF']."?PID=$id";
		}
		?>
			<tr class="innerCategory">
				<td valign="top" width="150px">
				<? if($image==""){?>
					<img src="../includes/images/noimage.png"/>
				<? } else {
					$image=str_replace("..", "../../admin", $image);
					?>
					<img src="<?=$image?>" style="max-width: 150px;max-height: 200px"/>
				<? }?>
				</td>
				<td valign="top">
					<h3><a href="<?=$goto?>" class="loadLink"><?=stripslashes($name)?></a></h3>
					<p><?=shortText(stripslashes($description),300)?></p>
				</td>
			</tr>
		<?php
		$i++;
	}
}
?>
</table>
<?php 
if($_REQUEST['ajax']){

}
else{
	echo "</div>";
	include_once '../common/footer.php';
}
?>