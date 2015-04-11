<?php
	require_once("./config/config.inc");
	$action = $_REQUEST[ACTION_FIELDNAME];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Administrador <?=$GLOBALS['conf']['client_name']?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="Keywords" content="<?=$GLOBALS['conf']['keywords']?>" />
	<meta name="Description" content="<?=$GLOBALS['conf']['description']?>" />
	<link rel="stylesheet" href="<?=STYLECSS?>" type="text/css" />
	<!-- icons -->
	<link rel="stylesheet" href="resources/font-awesome/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<!-- scripts -->
	<!--<script type="text/javascript" src="resources/scripts/ajax.js" ></script>-->
	<script type="text/javascript" src="resources/scripts/eventsMgr.js" ></script>
	<script type="text/javascript" src="resources/scripts/tabs.js" ></script>
	<script type="text/javascript" src="resources/scripts/moduleActions.js" ></script>
	<!-- content editor -->
	<script type="text/javascript" src="/cms/includes/scripts/ckeditor/ckeditor.js" ></script>
	<!-- bootstrap -->
	<link href="resources/scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<!-- jquery -->
	<script type="text/javascript" src="resources/scripts/jquery/jquery-1.11.1.min.js" ></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</head>