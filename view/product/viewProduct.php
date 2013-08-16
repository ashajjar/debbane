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

$sql = "SELECT * FROM `product` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );

if ($rows > 0) {
	$name = mysql_result ( $result, 0, "name" );
	$description = mysql_result ( $result, 0, "description" );
	$image = mysql_result ( $result, 0, "image" );
	$pdf = mysql_result ( $result, 0, "pdf" );
	$cid = mysql_result ( $result, 0, "cid" );
	$image=str_replace("..", "../../admin", $image);
	$pdf=str_replace("..", "../../admin", $pdf);
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="770px">
	<tr>
		<td valign="top" height="60px"><h1 style="margin-<?=mainDir?>: 0;margin-top: 0;"><?=stripslashes($name)?></h1>
		<br/><br/><h4><?=getProductPath($cid)?></h4>
		</td>
	</tr>
	<tr>
		<td><img src="<?=$image?>" style="max-width: 300px;max-height: 400px"/><br/></td>
	</tr>
	<tr>
		<td align="justify"><br/><?=stripslashes($description)?></td>
	</tr>
	<tr>
		<td><br/><i><?=_details?> <a href="#" onclick="document.location='../common/download.php?link=<?=$pdf?>';return false;"><?=_ClickHere?></a></i></td>
	</tr>
</table>
</form>
<?php
}else{
	echo "No selected product to be edited!";
}

if($_REQUEST['ajax']){

}
else{
	echo "</div>";
	include_once '../common/footer.php';
}
?>