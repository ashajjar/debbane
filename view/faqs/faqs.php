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
if($_REQUEST['id']){
	?>
	<script type="text/javascript">
	$(document).ready(function(){
		$('<?="#question_".$_REQUEST['id']?>').click();
	});
	</script>
	<?php
}
$sql="SELECT * FROM `faq` WHERE `isActive`='1' AND `lang`='$lang';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h1><?=_FAQs?></h1>
<table cellpadding="0" cellspacing="0" width="770px" align="center" border="0">
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$question=mysql_result($result, $i,"question");
		$answer=mysql_result($result, $i,"answer");
		
		?>
			<tr>
				<td valign="middle">
					<h3><a href="#" class="question" id="question_<?=$id?>"><?=$question?></a></h3>
					<div class="answer" id="answer_<?=$id?>"><?=$answer?></div>
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