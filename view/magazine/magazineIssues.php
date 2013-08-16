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
$year=$_REQUEST['year'];
$sql="SELECT * FROM `magazineissue` WHERE `year`='$year'";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h1><?=_mag_issues?></h1>
<table cellpadding="5" cellspacing="0" width="770px" align="center" border="0">
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$month=mysql_result($result, $i,"month");
		$pdf=mysql_result($result, $i,"pdf");
		$picture=mysql_result($result, $i,"picture");
		$pdf=str_replace("..", "../../admin", $pdf);
		?>
			<tr class="innerCategory">
				<td valign="top" width="150px">
				<? if($picture==""){?>
					<img src="../includes/images/noimage.png"/>
				<? } else {
					$picture=str_replace("..", "../../admin", $picture);
					?>
					<img src="<?=$picture?>" style="max-width: 150px;max-height: 200px"/>
				<? }?>
				</td>
				<td valign="top">
					<h2><?=_issue.getMonth($month)?></h2><br/><br/>
					<a href="<?="../magazine/issueTitles.php?issue_id=$id"?>" class="loadLink"><?=_View_Titles?></a>
					&nbsp;|&nbsp;
					<a href="#" onclick="document.location='../common/download.php?link=<?=$pdf?>';return false;"><?=_Download_Issue?></a>
				</td>
			</tr>
			<tr><td>&nbsp; </td></tr>
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