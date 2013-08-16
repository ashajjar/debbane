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


?>
<table align="center" border="0" cellpadding="0" cellspacing="5" width="100%" class="contactUsInfo">
	<tr>
		<td align="center" colspan="2">
			<p>
				<?=getDataCell("value", "configuration", "id", "2"," AND `lang`='$lang'")?>
			</p>
		</td>
	</tr>
	<tr>
		<td align="<?=reverseDir?>" width="40%">
			<strong><?=_Phone?> :</strong>
		</td>
		<td>
			<?=getDataCell("value", "configuration", "id", "4"," AND `lang`='$lang'")?>
		</td>
	</tr>
	<tr>
		<td align="<?=reverseDir?>">
			<strong><?=_Fax?> :</strong>
		</td>
		<td>
			<?=getDataCell("value", "configuration", "id", "5"," AND `lang`='$lang'")?>
		</td>
	</tr>
	<tr>
		<td align="<?=reverseDir?>">
			<strong><?=_EMail?> :</strong>
		</td>
		<td>
			<?=getDataCell("value", "configuration", "id", "3"," AND `lang`='$lang'")?>
		</td>
	</tr>
	<tr>
		<td align="<?=reverseDir?>">
			<strong><?=_Address?> :</strong>
		</td>
		<td>
			<?=getDataCell("value", "configuration", "id", "6"," AND `lang`='$lang'")?>
		</td>
	</tr>
</table>

<form action="#" method="post" name="contactus" id="ContactUsForm">
		
			<table align="center" border="0" cellpadding="0" cellspacing="5" width="100%">
				<tr>
					<td align="<?=reverseDir?>" valign="top" width="40%" class="formLabel">
						<?=_FullName?> (*)
					</td>
					
					<td valign="top" align="<?=mainDir?>">
						<input type="Text" name="name" id="cu_name" value="" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="<?=reverseDir?>" class="formLabel"><?=_Mobile?> (*)</td>
					<td valign="top" align="<?=mainDir?>">
						<input id="cu_mobile" type="Text" name="mobile" value="" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="<?=reverseDir?>" class="formLabel"><?=_Phone?> (*)</td>
					<td valign="top" align="<?=mainDir?>">
						<input id="cu_phone" type="Text" name="phone" value="" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="<?=reverseDir?>" class="formLabel"><?=_Country?> (*)</td>
					<td valign="top" align="<?=mainDir?>">
						<input id="cu_country" type="Text" name="country" value="" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="<?=reverseDir?>" class="formLabel"><?=_nl_email?> (*)</td>
					<td valign="top" align="<?=mainDir?>">
						<input id="cu_email" type="Text" name="email" value="" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="<?=reverseDir?>" class="formLabel"><?=_Subject?> (*)</td>
					<td valign="top" align="<?=mainDir?>">
						<input type="Text" name="subject" id="cu_subject" value="" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="<?=reverseDir?>" class="formLabel"><?=_Comments?> (*)</td>
					<td valign="top" align="<?=mainDir?>">
						<textarea name="message" id="cu_message" cols="42" rows="6" ></textarea>
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2" align="center">
						<input type="submit" name="submit" id="cu_submit" value="<?=_Send?>" class="button2" />
					</td>
				</tr>
			</table>
		</form>
<?php
if($_REQUEST['ajax']){

}
else{
	echo "</div>";
	include_once '../common/footer.php';
}
?>