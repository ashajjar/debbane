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
$PHP_SELF=$_SERVER['PHP_SELF'];
$url="";
$pn =  $_GET['pn'];
$so =  $_GET['so'];
$sb =  $_GET['sb'];
$LPP = 6;
$st = $pn*$LPP ;
$limit = "LIMIT $st,$LPP " ;

$sql="SELECT * FROM `news` WHERE `lang`='$lang' ORDER BY `id` DESC $limit;";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h1><?=News?></h1>
<table cellpadding="5" cellspacing="0" width="770px" align="center" border="0">
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$title=mysql_result($result, $i,"title");
		$brief=mysql_result($result, $i,"brief");
		$image=mysql_result($result, $i,"image");
		$date=mysql_result($result, $i,"date");
		
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
					<h3><a href="<?="../news/viewNews.php?id=$id"?>" class="loadLink"><?=stripslashes($title)?></a><span class="date">&nbsp;<?=_On?> <?=$date?></span></h3>
					<p><?=shortText(stripslashes($brief),300)?>...</p>
				</td>
			</tr>
		<?php
		$i++;
	}
}
?>
</table>
<div class="pagination"><?
	if(!$tp){$sql = "SELECT count(*) AS co FROM `news` WHERE `lang`='$lang';";
		$result = mysql_query($sql);
		$tp = mysql_result($result,'0','co');
		$numberOfRows=mysql_num_rows($result);
	}
	$pages = ceil($tp / $LPP);
	if(!$pn) $pn = 0;
	if(($pn+1) == $pages) {
		$start_index = $tp -( $numberOfRows -1) ;
		$endindex =$start_index +$numberOfRows -1;
	}else {
		$endindex = (($pn+1)*$numberOfRows) ;
		$start_index = $endindex -( $numberOfRows -1) ;
	}
	$start = max(0,($pn-3));
	$end = min($pages-1,($start+5));
	if($pn>0){echo "<a class='loadLink' href=$PHP_SELF?$url&tp=$tp&pn=".max(0,($pn-1)).">&laquo;".Previous."</a>&nbsp;";}
	for($i=$start;$i<=$end;$i++){
		if($i == $pn) echo '[<font color="#EE4717" size="3">'.($i+1).'</font>] ';
		else echo "<a class='loadLink' href=$PHP_SELF?$url&tp=$tp&pn=".($i).">".($i+1)."</a> ";
	}
	if($pn+1 < $pages){echo "&nbsp;<a class='loadLink' href=$PHP_SELF?$url&tp=$tp&pn=".min(($pn+1),$pages-1).">".Next."&raquo;</a>";}
	?>
</div>
<?php
if($_REQUEST['ajax']){

}
else{
	echo "</div>";
	include_once '../common/footer.php';
}
?>