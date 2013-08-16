<?php
include_once '../common/header.php';
$id = $_REQUEST ['id'];
$submit = $_POST['submit'];

if(isset($submit)){
	$from=getDataCell("value", "configuration", "id", "8"," AND `lang`='$lang'");
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	//$bcc=createEMailList();
	
	$template=file_get_contents("newsletter.tpl");
	$message=str_replace("###CONTENTS###", $message, $template);
	
	$to=createEMailArray();
	foreach ($to as $key=>$value) {
		$contact="$key <$value>";
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: ".$from." \r\n";
		$headers .= "BCC: ".$contact." \r\n";
		$s = @mail($from, $subject, $message, $headers);
	}
	
	echo "<script>document.location='newsletter.php';</script>";
}
?>
<script type="text/javascript">

$(document).ready(function(){
	$('#previewNL').click(function(){
		var message = $('#messagePV').val();
		//alert(message);
		$.ajax({
		      url: "newsletter.tpl",
		      success: function(msg){
					msg=msg.replace("###CONTENTS###",message);
					//alert(msg);
					var myWindow;
					var writeDoc;
					
					myWindow=window.open();
					writeDoc = myWindow.document;
					writeDoc.open();
					writeDoc.write(msg);
					writeDoc.close();
					myWindow.focus();
		      }
		   }
		);
	});
});

</script>
<h2>Send Newsletter</h2>

<form action="<?=$_SERVER ['PHP_SELF']?>" method="post"
	enctype="multipart/form-data"><input type="hidden" name="id"
	value="<?=$id?>" />
<table align="center" width="700px">
	<tr>
		<td>Subject :</td>
		<td><input type="text" name="subject" value="<?=$subject?>" /></td>
	</tr>

	<tr>
		<td>Message :</td>
		<td><textarea rows="5" cols="50" class="mceEditor" name="message"
			id="messagePV"><?=stripslashes ( $message )?></textarea></td>
	</tr>

	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Send" /> <input type="button" value="Back"
			onclick="document.location='newsletter.php';" /><input type="button"
			value="Preview" id="previewNL" /></td>
	</tr>
</table>
</form>
<?php
include_once '../common/footer.php';
?>