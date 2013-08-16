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

$sql = "SELECT * FROM `news` WHERE id='$id';";
$result = mysql_query ( $sql );
$rows = mysql_num_rows ( $result );

if ($rows > 0) {
	$title=mysql_result($result, 0,"title");
	$brief=mysql_result($result, 0,"brief");
	$details=mysql_result($result, 0,"details");
	$image=mysql_result($result, 0,"image");
	$date=mysql_result($result, 0,"date");
	$image=str_replace("..", "../../admin", $image);
	?>
<form action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<table align="center" width="770px">
	<tr>
		<td valign="top" height="60px"><h1 style="margin-<?=mainDir?>: 0;margin-top: 0;"><?=stripslashes($title)?></h1><br/>
		<br/><br/><span class="date" style="font-size: 14px;">&nbsp;On <?=$date?></span>
		</td>
	</tr>
	<tr>
		<td><img src="<?=$image?>" style="max-width: 300px;max-height: 400px"/><br/></td>
	</tr>
	<tr>
		<td align="justify"><br/><i><?=stripslashes($brief)?></i></td>
	</tr>
	<tr>
		<td align="justify"><br/><?=stripslashes($details)?></td>
	</tr>
	<tr>
		<td align="<?=reverseDir?>"><!--<a href="../news/news.php" class="loadLink"><?=_Back?></a>--></td>
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