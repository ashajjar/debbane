<?php
function emptyDir($dirPath){
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException('$dirPath must be a directory');
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (!is_dir($file)) {
            unlink($file);
        }
    }
}
function clearUploadsCache(){
	emptyDir("../uploads/cache");
	emptyDir("../../view/uploads/cache");
}
function getParentCat($cat) {
	$sql = "SELECT PID FROM `category` WHERE id='$cat'";
	$result = mysql_query ( $sql );
	$rows = mysql_num_rows ( $result );
	if ($rows > 0) {
		return mysql_result ( $result, 0, "PID" );
	} else {
		return null;
	}
}
function getCatLevel($cat) {
	$sql = "SELECT PID FROM `category` WHERE id='$cat'";
	$result = mysql_query ( $sql );
	$rows = mysql_num_rows ( $result );
	$pid = mysql_result ( $result, 0, "PID" );
	if($pid==0){
		return 1;
	}
	else{
		return getCatLevel($pid)+ 1;
	}
}
function getProductPath($cid) {
	$sql = "SELECT PID,name FROM `category` WHERE id='$cid'";
	$result = mysql_query ( $sql );
	$rows = mysql_num_rows ( $result );
	$pid = mysql_result ( $result, 0, "PID" );
	$name = mysql_result ( $result, 0, "name" );
	$level=getCatLevel($cid);
	if($level>=3){
		$goto="../product/products.php?cid=$cid";
	}
	else {
		$goto="../category/categories.php?PID=$cid";
	}
	
	if($pid==0){
		return "<a href='$goto' class='loadLink'>".$name."</a>";
	}
	else{
		return getProductPath($pid)." > <a href='$goto' class='loadLink'>".$name."</a>";
	}
}
function getDataCell($col, $table, $id, $value ,$cond="") {
	$sql = "SELECT `$col` FROM `$table` WHERE `$id`='$value' $cond;";
	$result = mysql_query ( $sql );
	$rows = mysql_num_rows ( $result );
	if ($rows > 0) {
		return mysql_result ( $result, 0, $col );
	} else {
		return null;
	}
}

function createComboBox($table, $id_field, $value_field, $id_value, $field_name, $required = "", $actions = "", $cond = "") {
	$result = "<select name=\"$field_name\" id=\"$field_name\" class=\"$required\" $actions>\n";
	$result .= "<option></option>\n";
	$sql_combo = "SELECT `$id_field` , `$value_field` from $table $cond ORDER BY $value_field";
	$result_combo = MYSQL_QUERY ( $sql_combo );
	$rows_combo = MYSQL_NUM_ROWS ( $result_combo );
	$i = 0;
	while ( $i < $rows_combo ) {
		$id = MYSQL_RESULT ( $result_combo, $i, $id_field );
		$filds = split ( ",", $value_field );
		$ind = 0;
		$value = "";
		while ( $ind < count ( $filds ) ) {
			$value .= MYSQL_RESULT ( $result_combo, $i, $filds [$ind] ) . " ";
			$ind ++;
		}
		$result .= "<option ";
		if ($id_value != null && $id_value != "" && $id_value == $id)
			$result .= "selected ";
		$result .= "value=\"$id\">" . stripslashes ( $value ) . "</option>\n";
		$i ++;
	}
	$result .= "</select>\n";
	return $result;
}

function createMonthsCombobox($selectedMonth, $field_name, $required = "", $actions = "", $cond = "") {
	$result = "";
	$result .= "<select name='$field_name' class='$required' $actions>\n";
	$result .= "<option></option>\n";
	for($i = 1; $i < 13; $i ++) {
		if ($i == $selectedMonth) {
			$selected = "selected='selected'";
		} else {
			$selected = "";
		}
		$result .= "<option $selected value='$i'>" . date ( "F", mktime ( 0, 0, 0, $i ) ) . "</option>\n";
	}
	$result .= "</select>\n";
	return $result;
}

/**
 * 
 * Newsletter
 */
function createEMailList(){
	$sql="SELECT * FROM `newsletter` WHERE `isActive`=1;";
	$result=mysql_query($sql);
	$rows=mysql_num_rows($result);
	if($rows>0){
		$i=0;
		$emailList="";
		while ($i<$rows){
			$name=mysql_result($result, $i,"name");
			$email=mysql_result($result, $i,"email");
			$emailList.="$name <$email>;";
			$i++;
		}
		return $emailList;
	}
	else {
		return "";
	}
}

function createEMailArray(){
	$sql="SELECT * FROM `newsletter` WHERE `isActive`=1;";
	$result=mysql_query($sql);
	$rows=mysql_num_rows($result);
	if($rows>0){
		$i=0;
		$emailList=array();
		while ($i<$rows){
			$name=mysql_result($result, $i,"name");
			$email=mysql_result($result, $i,"email");
			$emailList[$name]=$email;
			$i++;
		}
		return $emailList;
	}
	else {
		return "";
	}
}

function shortText($text, $len) {
	if (strlen ( $text ) > $len) {
		$to = strpos ( $text, " ", $len );
		if ($to !== false)
			$text = substr ( $text, 0, $to );
	}
	return $text;
}

/**
 * 
 * Form a query condition string from a field name and a set of values
 * 
 * @param string $fieldName the field that will be used to check its value
 * @param string $operation the operation that will be used to form the query condition
 * @param array $values array of values to form the query condition
 */
function formQueryString($fieldName,$operation,$values){
	$query="";
	$operation=strtolower($operation);
	switch ($operation){
		 case 'like':
		 	foreach ($values as $value){
		 		$query.="$fieldName LIKE ('%$value%') OR ";
		 	}
		 	$query=trim($query);
		 	$query=trim($query,"OR");
		 	break;
		 case '=':
		 	foreach ($values as $value){
		 		$query.="$fieldName = '$value' OR ";
		 	}
		 	$query=trim($query);
		 	$query=trim($query,"OR");
		 	break;
	}
	return " ( $query ) ";
}

function getMonth($month){
	switch ($month) {
		case 1:
			return _Jan;
		break;
		case 2:
			return _Feb;
		break;
		case 3:
			return _Mar;
		break;
		case 4:
			return _Apr;
		break;
		case 5:
			return _May;
		break;
		case 6:
			return _Jun;
		break;
		case 7:
			return _Jul;
		break;
		case 8:
			return _Aug;
		break;
		case 9:
			return _Sep;
		break;
		case 10:
			return _Oct;
		break;
		case 11:
			return _Nov;
		break;
		case 12:
			return _Dec;
		break;
		default:
			return null;
		break;
	}
}

function getServerURL() {
	$serverURL = 'http';
	if ($_SERVER ["HTTPS"] == "on") {
		$serverURL .= "s";
	}
	$serverURL .= "://";
	if ($_SERVER ["SERVER_PORT"] != "80") {
		$serverURL .= $_SERVER ["SERVER_NAME"] . ":" . $_SERVER ["SERVER_PORT"];
	} else {
		$serverURL .= $_SERVER ["SERVER_NAME"];
	}
	return $serverURL;
}
?>