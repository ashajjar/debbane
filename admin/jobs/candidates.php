<?php
include_once '../common/header.php';

$id=$_REQUEST['id'];
$sql="SELECT * FROM `jobapplication` WHERE `offer_id`='$id'";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Candidates</h2>
<table width="100%">
	<tr>
		<td class="new">
			<form action="../includes/export.php" method="post">
				<input type="hidden" name="SQL" value="<?=$sql?>"/>
				<input type="hidden" name="outputFilename" value="<?="Candidates-".getDataCell("jobCode", "joboffer", "id", $id).".xls"?>"/>
				<input type="submit" name="submit" value="Export" style="border: 0;background-color: #fff"/>
			</form>
		</td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="200px">Name</th>
		<th width="200px">E-mail</th>
		<th width="100px">Phone </th>
		<th width="200px">Photo</th>
		<th width="100px">File 1</th>
		<th width="100px">File 2</th>
		<th width="100px">File 3</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$fullName=mysql_result($result, $i,"fullName");
		$email=mysql_result($result, $i,"email");
		$phone=mysql_result($result, $i,"phone");
		$photo=mysql_result($result, $i,"photo");
		$attachment1=mysql_result($result, $i,"attachment1");
		$attachment2=mysql_result($result, $i,"attachment2");
		$attachment3=mysql_result($result, $i,"attachment3");
		?>
			<tr>
				<td valign="top">&nbsp;<?=stripslashes($fullName)?></td>
				<td valign="top">&nbsp;<?=stripslashes($email)?></td>
				<td valign="top">&nbsp;<?=stripslashes($phone)?></td>
				<td valign="top">
					<? if($photo!=""){?>
						<img src="<?=stripslashes($photo)?>"  style="max-width: 150px;max-height: 200px" />
					<? }else { echo "&nbsp";}?>
				</td>
				
				<td valign="top">
					<? if($attachment1!=""){?>
					<a href="<?=stripslashes($attachment1)?>">View File 1</a>
					<? }else { echo "&nbsp";}?>
				</td>
				<td valign="top">
					<? if($attachment2!=""){?>
					<a href="<?=stripslashes($attachment2)?>">View File 2</a>
					<? }else { echo "&nbsp";}?>
				</td>
				<td valign="top">
					<? if($attachment3!=""){?>
					<a href="<?=stripslashes($attachment3)?>">View File 3</a>
					<? }else { echo "&nbsp";}?>
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