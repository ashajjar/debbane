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

$sql = "SELECT * FROM `configuration` WHERE id='$id' AND `lang`='$lang';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );
if ($rows > 0) {
	$id=mysql_result($result, 0,"id");
	$key=mysql_result($result, 0,"key");
	$value=mysql_result($result, 0,"value");
	$type=mysql_result($result, 0,"type");
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="770px">
	<tr>
		<td valign="top" height="60px"><h1 style="margin-<?=mainDir?>: 0;margin-top: 0;"><?=stripslashes($key)?></h1>
		</td>
	</tr>
	<tr>
		<td align="justify"><br/><?=stripslashes($value)?></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected setting to be edited!";
}
if($_REQUEST['ajax']){

}
else{
	echo "</div>";
	include_once '../common/footer.php';
}
?>