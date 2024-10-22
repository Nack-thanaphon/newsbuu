<!DOCTYPE html>
<html class="no-js" lang="zxx" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
    <!-- Title -->
  	<title>มหาวิทยาลัยบูรพา วิทยาเขตจันทบุรี : <?=$this->title?></title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?=$this->description?>">
	<meta name="keywords" content="มหาวิทยาลัยบูรพา วิทยาเขตจันทบุรี, มหาวิทยาลัยบูรพา, วิทยาเขตจันทบุรี, BUU, Burapha, จันทบุรี , ม.บุรพาจันทบุรี, เรียนจันทบุรี">

    <?php
     if(!empty($_GET['m']) && $_GET['m']=='detail'){
       echo $this->xFunction->metaTAG($this->canonical,$this->title,$this->description,$this->og_images);
     }
    ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="<?=$this->assets?>images/favicon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=K2D:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=thai" rel="stylesheet">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=$this->assets?>css/bootstrap.min.css">
	<!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?=$this->assets?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$this->assets?>vendor/fonts-fontello/fontello.css" type="text/css">
		<!-- Fancy Box CSS -->
    <link rel="stylesheet" href="<?=$this->assets?>css/jquery.fancybox.min.css">
		<!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="<?=$this->assets?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=$this->assets?>css/owl.theme.default.min.css">
		<!-- Animate CSS -->
    <link rel="stylesheet" href="<?=$this->assets?>css/animate.min.css">
		<!-- Slick Nav CSS -->
    <link rel="stylesheet" href="<?=$this->assets?>css/slicknav.min.css">
    <!-- Magnific Popup -->
	<link rel="stylesheet" href="<?=$this->assets?>css/magnific-popup.css">
	<!-- Learedu Stylesheet -->
    <link rel="stylesheet" href="<?=$this->assets?>css/normalize.css">
    <link rel="stylesheet" href="<?=$this->assets?>style.css">
    <link rel="stylesheet" href="<?=$this->assets?>css/responsive.css">
	<!-- Learedu Color -->
	<link rel="stylesheet" href="<?=$this->assets?>css/color/color-buu.css">
    <script src="<?=$this->assets?>js/jquery.min.js"></script>

    <style>
    	.event-content img {height: auto !important;}
    </style>
    
    </head>
    <body>
