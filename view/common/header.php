<?php
include_once '../../common/database.php';
include_once '../includes/imaging.php';
include_once '../includes/utils.php';
include_once "../labels/labels_$lang.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1256" />
<title><?=_Company?></title>

<script type="text/javascript" src="../includes/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../includes/js/<?=$lang?>.js"></script>
<script type="text/javascript" src="../includes/js/common.js"></script>
<script type="text/javascript" src="../includes/js/login.js"></script>
<script type="text/javascript" src="../includes/js/catAccordion.js"></script>
<script type="text/javascript" src="../includes/js/slideImages.js"></script>
<script type="text/javascript" src="../includes/js/linkLoader.js"></script>
<script type="text/javascript" src="../includes/js/contactus.js"></script>
<script type="text/javascript" src="../includes/js/newsletter.js"></script>
<script type="text/javascript" src="../includes/js/faqs.js"></script>
<script type="text/javascript" src="../includes/js/menu.js"></script>
<script type="text/javascript" src="../includes/js/socialButtons.js"></script>
<script type="text/javascript" src="../includes/js/validator.js"></script>

<script type="text/javascript" src="../includes/jquery-ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" href="../includes/jquery-ui/level1cats/jquery-ui-1.8.16.custom.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="../includes/jquery-ui/level2cats/jquery-ui-1.8.16.custom.css" type="text/css" media="screen"/>

<link rel="stylesheet" href="../includes/jquery-ui/logocontainer/jquery-ui-1.8.16.custom.css" type="text/css" media="screen"/>

<link rel="stylesheet" href="../includes/css/main_<?=$pageDir?>.css" type="text/css" media="screen"/>
<link rel="shortcut icon" href="../includes/images/icon.png" />
</head>

<body>
<div class="messageBox"></div>
<div class="emailForm">
	<form action="#">
		<table width="auto" border="0" cellpadding="5" cellspacing="0" align="center">
			<tr>
				<td colspan="2" height="40px"><label id="stf_errors"></label></td>
			</tr>
			<tr>
				<td><label for="stf_name"><?=Your_name?>:</label></td>
				<td><input size="30" id="stf_name" name="name" value="" type="text" title="Your name!" /></td>
			</tr>
			<tr>
				<td><label for="stf_from"><?=Your_email?>:</label></td>
				<td><input size="30" id="stf_from" name="from" value="" type="text" title="Your E-Mail address!" /></td>
			</tr>
			<tr>
				<td><label for="stf_fname"><?=Friend_name?>:</label></td>
				<td><input size="30" id="stf_fname" name="fname" value="" type="text" title="Your friend's name!" /></td>
			</tr>
			<tr>
				<td><label for="stf_email"><?=Friend_email?>:</label></td>
				<td><input size="30" id="stf_email" name="email" value="" type="text" title="The e-mail to which you want to send this!" /></td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="button" id="stf_sendEMail" value="<?=_Send?>"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" id="stf_cancelSending" value="<?=_Cancel?>"/></td>
			</tr>
		</table>
	</form>
</div>
    <div class="mainContainer">
		<div class="header" id="__pageTop">
			<div class="logoContainer">
				<a href="../index" class="external-link">
					<img src="../includes/images/logo.png" class="logo"/>
				</a>
				
				<h4><?=_Categories?></h4>
				
				<?php 
				
				$sql ="SELECT * FROM `category` WHERE `PID`='0' AND `lang`='$lang';";
				$result=mysql_query($sql);
				$rows=mysql_num_rows($result);
				if($rows>0){
					$i=0;
					while ($i<$rows){
						$id=stripslashes(mysql_result($result, $i,"id"));
						$name=stripslashes(mysql_result($result, $i,"name"));
						echo "<div class='proListItem level1' id='title_$id'><a href='../category/categories.php?PID=$id' class='loadLink'>$name</a></div>";
						echo "<div class='subCat level1subCat' id='content_$id'>";
						
						$sub_sql ="SELECT * FROM `category` WHERE `PID`='$id' AND `lang`='$lang';";
						$sub_result=mysql_query($sub_sql);
						$sub_rows=mysql_num_rows($sub_result);
						if($sub_rows>0){
							$j=0;
							while ($j<$sub_rows){
								$sub_id=stripslashes(mysql_result($sub_result, $j,"id"));
								$sub_name=stripslashes(mysql_result($sub_result, $j,"name"));
								
								echo "<div class='proListItem level2' id='title_$sub_id'><a href='../category/categories.php?PID=$sub_id' class='loadLink'>$sub_name</a></div>";
								echo "<div class='subCat level2subCat' id='content_$sub_id'>";
								
								$sub_sub_sql ="SELECT * FROM `category` WHERE `PID`='$sub_id' AND `lang`='$lang';";
								$sub_sub_result=mysql_query($sub_sub_sql);
								$sub_sub_rows=mysql_num_rows($sub_sub_result);
								if($sub_sub_rows>0){
									$k=0;
									while ($k<$sub_sub_rows){
										$sub_sub_id=stripslashes(mysql_result($sub_sub_result, $k,"id"));
										$sub_sub_name=stripslashes(mysql_result($sub_sub_result, $k,"name"));
										echo "<div class='proListItem level3' id='title_$sub_sub_id'><a href='../product/products.php?cid=$sub_sub_id' class='loadLink'>$sub_sub_name</a></div>";
										echo "<div class='subCat level3subCat' id='content_$sub_sub_id'>";
										echo "</div>";
										$k++;
									}
								}
								
								echo "</div>";
								$j++;
							}
						}
						
						echo "</div>";
						$i++;
					}
				}
				
				?>
				
				
			</div>
			<div class="headerControls">
				<div class="loginBox">
					<form action="#" method="post" id="userLoginForm">
						<table cellpadding="1" cellspacing="0" width="100%" border="0" align="center">
							<tr>
								<td>
									<input type="text" name="user" id="user" value="<?=_username?>"
									onblur="if(this.value=='')this.value='<?=_username?>';"
									onfocus="if(this.value=='<?=_username?>')this.value='';">
								</td>
								<td>
									<input type="password" name="pass" id="pass" value="<?=_password?>"
									onblur="if(this.value=='')this.value='<?=_password?>';"
									onfocus="if(this.value=='<?=_password?>')this.value='';">
								</td>
								<td>
									<input type="button" name="submit" id="doUserLogin" value="" />
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<span class="loginLinks"><a href="../users/forgotPassword.php" class="loadLink"><?=_forgotPW?> </a> | <a href="../users/register.php" class="loadLink"><?=_Register?></a></span>
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div class="moto"></div>
				<div class="profile"><a href="?lang=<?=_OtherLang_abbr?>"><?=_OtherLang?></a></div>
			</div>
			<div class="menuContainer">
				<div class="menuItem"><a href="../index" class="external-link"><?=_Home?></a></div>
				<div class="menuItem"><a href="../common/view.php?id=1" class="loadLink"><?=_about?></a></div>
				<div class="menuItem"><a href="#" onclick="document.location='../common/download.php?link=<?="../../profile.pdf"?>';return false;"><?=_Profile?></a></div>
				<div class="menuItem"><a href="../news/news.php" class="loadLink"><?=_News?></a></div>
				<div class="menuItem"><a href="../magazine/magYears.php" class="loadLink"><?=_Magazine?></a></div>
				<div class="menuItem"><a href="../faqs/faqs.php" class="loadLink"><?=_FAQs?></a></div>
				<div class="menuItem"><a href="../common/contactus.php" class="loadLink"><?=_contact?></a></div>
				<div class="searchBox">
					<form action="../search/search.php" method="get">
						<input type="text" name="keywords" id="keywords" value="<?=_Search?>"
						onblur="if(this.value=='')this.value='<?=_Search?>';"
						onfocus="if(this.value=='<?=_Search?>')this.value='';"
						/>
						<input type="submit" name="submit" value=""/>
					</form>
				</div>
			</div>
		</div>
		<img src="../includes/images/ajax-loader.gif" class="waitImage" alt="" />
		<div class="innerContainer">
		</div>