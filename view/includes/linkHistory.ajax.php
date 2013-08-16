<?php
session_start();
$historyArray=$_SESSION['__HISTORY'];
if (!$historyArray) {
	$historyArray=array();
}
$op=$_REQUEST['op'];
$link=$_REQUEST['link'];
if($op=="a"){//Add
	array_push($historyArray, $link);
	$_SESSION['__HISTORY']=$historyArray;
}
elseif($op=="r"){//Remove
	$c=count($historyArray);
	if($c<=1){
		echo "";
	}
	else{
		$l1 = array_pop($historyArray);
		$l2 = array_pop($historyArray);
		if(!$l2){
			echo $l1;
		}
		else{
			echo $l2;
		}
		$_SESSION['__HISTORY']=$historyArray;
	}
}
else{
}
?>