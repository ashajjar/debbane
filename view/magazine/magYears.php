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
$sql="SELECT DISTINCT (`year`) as `year` FROM `magazineissue` ORDER BY `year` DESC ";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h1><?=_mag_year?></h1>
<table cellpadding="5" cellspacing="0" width="770px" align="center" border="0">
	<tr class="innerCategory">
		<td valign="top">
			<ul>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$year=mysql_result($result, $i,"year");
		?>
			<li><a href="<?="../magazine/magazineIssues.php?year=$year"?>" class="loadLink"><?=$year?></a></li>
		<?php
		$i++;
	}
}
?>
			</ul>
		</td>
	</tr>
</table>
<?php 
if($_REQUEST['ajax']){

}
else{
	echo "</div>";
	include_once '../common/footer.php';
}
?>