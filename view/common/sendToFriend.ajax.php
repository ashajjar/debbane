<?php
session_start();

include_once '../includes/utils.php';

if($_SESSION['lang']=="") $_SESSION['lang']="en";
if($_REQUEST['lang']) $lang=$_SESSION['lang']=$_REQUEST['lang'];
else $lang=$_SESSION['lang'];

include_once "../labels/labels_$lang.php";


$from=$_REQUEST['from'];
$to=$_REQUEST['to'];
$link=$_REQUEST['link'];
$name=$_REQUEST['name'];
$friendName=$_REQUEST['fname'];
$details=str_replace("##FNAME##", $friendName, STF_MESSAGE);
$details=str_replace("##NAME##", $name, $details);
$details=str_replace("##LINK##", $link, $details);

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=windows-1256\r\n";

/* additional headers */
$headers .= "To: $friendName <$to> \r\n";
$headers .= "From: $name <$from> \r\n";

$subject = Message_from_your_friend;

$s = @mail($to, $subject, $details, $headers);
echo "<br/>";
if($s)  echo STF_DONE;
else echo STF_FAILED;
?>