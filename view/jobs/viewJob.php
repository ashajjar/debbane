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
$id = $_REQUEST ['id'];

$sql = "SELECT * FROM `joboffer` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );

if ($rows > 0) {
		$title=mysql_result($result, 0,"title");
		$jobCode=mysql_result($result, 0,"jobCode");
		$department=mysql_result($result, 0,"department");
		$responsibilities=mysql_result($result, 0,"responsibilities");
		$qualifications=mysql_result($result, 0,"qualifications");
		$joblang=mysql_result($result, 0,"lang");
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post"
	enctype="multipart/form-data">
<table align="center" width="770px">
	<tr>
		<td><h1 style="width: 100%"><?=stripslashes ( $title )?></h1>(<?=stripslashes ( $jobCode )?>) <?=_forDept?>:<?=stripslashes ( $department )?></td>
	</tr>
	
	<tr>
		<td><h3><?=_Responsibilities?></h3><?=stripslashes ( $responsibilities )?></td>
	</tr>
	<tr>
		<td><h3><?=_Qualifications?></h3><?=stripslashes ( $qualifications )?></td>
	</tr>
	<tr>
		<td><a href="../jobs/apply.php?id=<?=$id?>" class="loadLink"><?=_Apply?></a></td>
	</tr>
</table>
</form>
<?php
}
if($_REQUEST['ajax']){

}
else{
	echo "</div>";
	include_once '../common/footer.php';
}
?>