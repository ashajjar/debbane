<?php
include_once 'security.php';
include_once '../../common/database.php';
include_once '../includes/imaging.php';
include_once '../includes/utils.php';
include_once "../labels/labels_$lang.php";
header('Content-Type: text/html; charset=Windows-1256');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<title>Debbane CMS Admin</title>
	<script type="text/javascript" src="../includes/js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../includes/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="../includes/js/common.js"></script>
	<script type="text/javascript" src="../includes/js/validator.js"></script>
	<link rel="stylesheet" type="text/css" href="../includes/css/main.css" />
	
	<script type="text/javascript" src="../includes/CatSelect/catSelect.js" ></script>
	<link rel="stylesheet" type="text/css"  href="../includes/CatSelect/catSelect.css" />
	<script type="text/javascript" src="../includes/tinymce/jscripts/tiny_mce/classes/tinymce.js"></script>
	<script type="text/javascript" src="../includes/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="../includes/tinymce/jscripts/tiny_mce/plugins/imagemanager/js/mcimagemanager.js" ></script>
	<link rel="stylesheet" href="../includes/css/jquery-ui-1.8.16.custom.css" type="text/css" media="screen"/>
	<script> initEditor();</script>
	
</head>
<body>
<div class="header">
	<div class="menuBar">
		<div class="logo"></div>
		<div class="menuItem"><a href="../config/siteSettings.php">Site Settings</a></div>
		<div class="menuItem"><a href="../category/categories.php">Categories</a></div>
		<div class="menuItem"><a href="../profile/uploadProfile.php">Profile</a></div>
		<div class="menuItem"><a href="../highlight/highlights.php">Highlights</a></div>
		<div class="menuItem"><a href="../news/news.php">News</a></div>
		<div class="menuItem"><a href="../magazine/magazineIssues.php">Magazine</a></div>
		<div class="menuItem"><a href="../faqs/faqs.php">FAQs</a></div>
		<div class="menuItem"><a href="../links/links.php">Links</a></div>
		<div class="menuItem"><a href="../message/messages.php">Messages</a></div>
		<div class="menuItem"><a href="../users/users.php">Users</a></div>
		<div class="menuItem"><a href="../newsletter/newsletter.php">Newsletter</a></div>
		<div class="menuItem"><a href="../jobs/jobs.php">Jobs</a></div>
		<div class="menuItem"><a href="../index/logout.php">Logout</a></div>
	</div>
</div>
<div class="messageBox"></div>
<div class="mainContents">
