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
<h1><?=_Results?></h1>
<table cellpadding="5" cellspacing="0" width="770px" align="center" border="0">
	<tr class="innerCategory">
		<td valign="top">
<?
if($_REQUEST['keywords']!=""){
$s=trim($_REQUEST['keywords']);
$words=explode(" ", $s);
if(!is_array($words))
{
	$words=array($s);
}

//Categories
$sql_cats="select * from `category` where (".formQueryString("name", "Like", $words)." OR ".formQueryString("description", "LIKE", $words)."  )  AND `lang`='$lang' ";		
$res_cats=mysql_query($sql_cats);
$rows_cats=mysql_num_rows($res_cats);

if($rows_cats>0){?>
	<h3><?=Categories." (".($rows_cats).")"?></h3>
	<ul>
	<?
	$i=0;
	while($i<$rows_cats){
		$name= mysql_result($res_cats,$i,'name');
		$PID= mysql_result($res_cats,$i,'PID');
		?>
		<li><a class="loadLink" href="../category/categories.php?PID=<?=$PID?>"><?=$name?></a></li>
		<?
		$i++;
	}
	?>
	</ul>
	<?
}
//Products
$sql_pros="select * from `product` where (".formQueryString("name", "Like", $words)." OR ".formQueryString("description", "LIKE", $words)."  ) AND `lang`='$lang' ";		
$res_pros=mysql_query($sql_pros);
$rows_pros=mysql_num_rows($res_pros);

if($rows_pros>0){?>
	<h3><?=Products." (".($rows_pros).")"?></h3>
	<ul>
	<?
	$i=0;
	while($i<$rows_pros){
		$name= mysql_result($res_pros,$i,'name');
		$id= mysql_result($res_pros,$i,'id');
		?>
		<li><a class="loadLink" href="../product/viewProduct.php?id=<?=$id?>"><?=$name?></a></li>
		<?
		$i++;
	}
	?>
	</ul>
	<?
}
//News
$sql_news="select * from `news` where (".formQueryString("title", "Like", $words)." OR ".formQueryString("brief", "LIKE", $words)." OR ".formQueryString("details", "LIKE", $words)."  ) AND `lang`='$lang' ";		
$res_news=mysql_query($sql_news);
$rows_news=mysql_num_rows($res_news);

if($rows_news>0){?>
	<h3><?=News." (".($rows_news).")"?></h3>
	<ul>
	<?
	$i=0;
	while($i<$rows_news){
		$title= mysql_result($res_news,$i,'title');
		$id= mysql_result($res_news,$i,'id');
		?>
		<li><a class="loadLink" href="../news/viewNews.php?id=<?=$id?>"><?=$title?></a></li>
		<?
		$i++;
	}
	?>
	</ul>
	<?
}
//Magazine Title
$sql_mag="select * from `magazinetitle` where (".formQueryString("title_$lang", "Like", $words)." OR ".formQueryString("brief_$lang", "LIKE", $words)."  )";		
$res_mag=mysql_query($sql_mag);
$rows_mag=mysql_num_rows($res_mag);

if($rows_mag>0){?>
	<h3><?=MagTitles." (".($rows_mag).")"?></h3>
	<ul>
	<?
	$i=0;
	while($i<$rows_mag){
		$title= mysql_result($res_mag,$i,'title');
		$id= mysql_result($res_mag,$i,'issue_id');
		?>
		<li><a class="loadLink" href="../magazine/issueTitles.php?issue_id=<?=$id?>"><?=$title?></a></li>
		<?
		$i++;
	}
	?>
	</ul>
	<?
}
//FAQs
$sql_faqs="select * from `faq` where (".formQueryString("question", "Like", $words)." OR ".formQueryString("answer", "LIKE", $words)."  ) AND `lang`='$lang' ";		
$res_faqs=mysql_query($sql_faqs);
mysql_error();
$rows_faqs=mysql_num_rows($res_faqs);
if($rows_faqs>0){?>
	<h3><?=_FAQs." (".($rows_faqs).")"?></h3>
	<ul>
	<?
	$i=0;
	while($i<$rows_faqs){
		$title= mysql_result($res_faqs,$i,'question');
		$id= mysql_result($res_faqs,$i,'id');
		?>
		<li><a class="loadLink" href="../faqs/faqs.php?id=<?=$id?>"><?=$title?></a></li>
		<?
		$i++;
	}
	?>
	</ul>
	<?
}
$all_res=$rows_cats+$rows_faqs+$rows_mag+$rows_news+$rows_pros;
if($all_res>0){
	echo "<h4>"._search_msg." (".$all_res.")</h4>";
}
else
{
	echo "<h4>"._no_results."</h4>";
}

}
else
{
	echo "<script>
	$(document).ready(function(){
		showMessageBox('<p>There were no keywords to search for!</p>');
		setTimeout('document.location=\"../index/\"',3000);
	});
	</script>";
}
?>
		</td>
	</tr>
</TABLE>
<?php 
if($_REQUEST['ajax']){

}
else{
	echo "</div>";
	include_once '../common/footer.php';
}
?>