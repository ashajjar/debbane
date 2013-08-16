<?php
include_once '../../common/database.php';
include_once '../includes/utils.php';
include_once "../labels/labels_$lang.php";

$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$subject=$_REQUEST['subject'];
$message=$_REQUEST['message'];
$mobile=$_REQUEST['mobile'];
$phone=$_REQUEST['phone'];
$country=$_REQUEST['country'];

$to=getDataCell("value", "configuration", "id", "3");

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=windows-1256\r\n";
$headers .= "To:".$to."\r\n";
$headers .= "From: ".$email." \r\n";

$message  ='
<table width="600" border="0" cellspacing="0" cellpadding="3" dir="'.pageDir.'" style="font-family:Tahoma, Geneva, sans-serif">
<tr><td colspan="2" stl="stl">New contact message from your website</td></tr>
<tr><td width="114"><b>Name:</b></td><td width="474">'.$name.'</td></tr>
<tr><td><b>E-Mail:</b></td><td>'.$email.'</td></tr>
<tr><td><b>Mobile:</b></td><td>'.$mobile.'</td></tr>
<tr><td><b>Phone:</b></td><td>'.$phone.'</td></tr>
<tr><td><b>Country:</b></td><td>'.$country.'</td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td colspan="2"><b>Subject : '.$subject.'</b></td></tr>
<tr><td colspan="2">'.$message.'</td></tr></table>';
$sql="INSERT INTO `message` ( `id` , `name` , `email` , `mobile` , `phone` , `country` , `subject` , `date` , `message` , `isRead` , `isReplied` )
					VALUES (NULL , '$name', '$email', '$mobile' , '$phone' , '$country' , '$subject', NOW(), '$message', '0', '0');";
if(mysql_query($sql)){
	$s = @mail($to, $subject, $message, $headers);
	echo "sent" ;
}
else {
	echo "failed";
}

?>