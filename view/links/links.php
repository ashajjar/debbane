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

$sql="SELECT * FROM `link` WHERE `lang`='$lang';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h1><?=_Links?></h1>
<table cellpadding="0" cellspacing="0" width="770px" align="center" border="0">
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$title=mysql_result($result, $i,"title");
		$link=mysql_result($result, $i,"link");
		$description=mysql_result($result, $i,"description");
		
		?>
			<tr class="innerCategory">
				<td valign="top">
					<h3><a href="<?=$link?>" target="_blank"><?=stripslashes($title)?></a></h3>
					<p><?=stripslashes($description)?></p>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
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