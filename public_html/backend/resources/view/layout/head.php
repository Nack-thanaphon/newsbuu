<!DOCTYPE html>
<html lang="th">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title><?=$this->lang->sitename?></title>
<meta name="description" content="" />
<!-- bootstrap & fontawesome -->
<link rel="stylesheet"  href="<?=$this->_assets?>css/bootstrap.min.css" />
<link rel="stylesheet"  href="<?=$this->_assets?>font-awesome/font-awesome.min.css" />
<!-- page specific plugin styles --><!-- text fonts -->
<link rel="stylesheet"  href="<?=$this->_assets?>css/fonts.googleapis.com.css" />
<!-- ace styles -->
<link rel="stylesheet"  href="<?=$this->_assets?>css/ace.min.css"  class="ace-main-stylesheet"  id="main-ace-style" />
<!--[if lte IE 9]><link rel="stylesheet"  href="<?=$this->_assets?>css/ace-part2.min.css"  class="ace-main-stylesheet" /><![endif]-->
<link rel="stylesheet"  href="<?=$this->_assets?>css/ace-skins.min.css" />
<link rel="stylesheet"  href="<?=$this->_assets?>css/ace-rtl.min.css" />
<!--[if lte IE 9]><link rel="stylesheet"  href="<?=$this->_assets?>css/ace-ie.min.css" /><![endif]-->
<!-- inline styles related to this page -->
<!-- ace settings handler -->
<script src="<?=$this->_assets?>js/ace-extra.min.js" ></script>
<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
<!--[if lte IE 8]><script src="<?=$this->_assets?>js/html5shiv.min.js" ></script>
<script src="<?=$this->_assets?>js/respond.min.js" ></script>
<![endif]--><script src="<?=$this->_assets?>js/jquery-2.1.4.min.js" ></script>
<!--[if IE]><script src="<?=$this->_assets?>js/jquery-1.11.3.min.js" ></script><![endif]-->
<link rel="stylesheet"  href="<?=$this->_assets?>custom/screen.css?v=<?=time()?>" />
<script src="<?=$this->plugins?>time/time.js" ></script>
</head>
<body class="no-skin" onload="startTime()" >
