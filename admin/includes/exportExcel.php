<?php
/**
 * Exports table specific data to excel file according to some condition   
 * 
 * @param string $table table from which the data will be exported
 * @param string $fields (Optional) A comma separated list of fields to export from the specified table
 * @param string $condition (Optional) Free condition according to which data will be retrieved
 * @param string $orderBy (Optional) A comma separated list of fields to order exported data according to it
 * @param string $outputFilename (Optional) The name of the excel file to be exported 
 */
function exportDataToExcel($table,$fields="*",$condition="",$orderBy="",$outputFilename="default.xls"){
	$sql="SELECT $fields FROM `$table` ";
	$sql.=($condition!="")?" WHERE ".$condition:"";
	$sql.=($orderBy!="")?" ORDER BY ".$orderBy:"";
	if(exportSqlToExcel($sql,$outputFilename)==false){
		return false;
	}
}
/**
 * Exports the result of the specified SQL query
 * 
 * @param string $sql the SQL statement according to which the data will be exported
 * @param string $outputFilename (Optional) The name of the excel file to be exported 
 */
function exportSqlToExcel($sql,$outputFilename="default.xls"){
	$sql=stripslashes($sql);
	$result=mysql_query($sql);
	$numRows=mysql_num_rows($result);
	$excelArray=array();
	if($numRows>0){
		$i = 0;
		$headerRow=array();
		while ($i < mysql_num_fields($result)) {
			$meta = mysql_fetch_field($result, $i);
			$headerRow[]=$meta->name;
			$i++;
		}
		$excelArray[]=$headerRow;
		$i=0;
		while($i<$numRows){
			$arr=array();
			$arr=mysql_fetch_array($result,MYSQL_NUM);
			$excelArray[]=$arr;
			$i++;
		}
		exportArrayToExcel($excelArray,$outputFilename);
	}
	else 
	{
		return false;
	}
}
/**
 * Exports the passed array to an excel file
 * 
 * @param Array $arr a 2-D array to export to excel
 * @param string $outputFilename (Optional) The name of the excel file to be exported
 */
function exportArrayToExcel($arr,$outputFilename="default.xls"){
	if(countDimensions($arr)<2)
	{
		return false;
	}
	$rows=count($arr);
	$excelFileContents="";
	for($i=0;$i<$rows;$i++)
	{
		$cols=count($arr[$i]);
		for($j=0;$j<$cols;$j++)
		{
			cleanData($arr[$i][$j]);
			$excelFileContents.=strip_tags($arr[$i][$j])."\t";
		}
		rtrim($excelFileContents);
		$excelFileContents.="\r\n";
	}
	// Send Header
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header('Content-type: application/ms-excel; charset=utf8');
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header ( 'Content-Disposition: attachment; filename=' . $outputFilename );
	header ( "Content-Transfer-Encoding: binary ");
	echo $excelFileContents;
}
/**
 * Counts number of dimensions in an array
 * 
 * @param Array $array the array to count its number of dimensions
 */
function countDimensions($array){
	if (is_array(reset($array))){
		$return = countDimensions(reset($array)) + 1;
	}
	else
	{
		$return = 1;
	}
	return $return;
}
function cleanData(&$str) {
	$str = preg_replace("/\t/", "\\t", $str);
	$str = preg_replace("/\r?\n/", "\\n", $str);
}
?>