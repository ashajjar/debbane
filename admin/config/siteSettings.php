<?php
include_once '../common/header.php';

$sql="SELECT * FROM `configuration` WHERE `lang`='$lang';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Site Settings</h2>
<table width="100%">
	<tr>
		<td class="new"> &nbsp; </td>
		<td class="new" align="right"><?=createComboBox("Languages", "code", "language", $lang, "lang","","onchange=\"document.location='?lang='+this.value\";")?></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="800px">Item</th>
		<th width="200px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$key=mysql_result($result, $i,"key");
		$value=mysql_result($result, $i,"value");
		$type=mysql_result($result, $i,"type");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=stripslashes($key)?></td>
				<td valign="top">
					<a href="editSetting.php?id=<?=$id?>">Change</a>
				</td>
			</tr>
		<?php
		$i++;
	}
}
?>
</table>
<?php
include_once '../common/footer.php';
?>

