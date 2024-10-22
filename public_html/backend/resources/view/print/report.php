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
<style>
body{
	font-size: 12px;
	margin: 10px;
}
h1{
	font-size: 30px;
	font-weight:500;
}
table.items_list{margin: 5px 0 5px 0;border:1px solid #ccc;   }
table.items_list thead>tr>th{ color: #666 !important;  }
table.items_list thead>tr>th,table.items_list tbody>tr>td{ font-size: 12px !important;  padding: 3px !important;     border-color: #ccc;    }
</style>
</head>
<body>
		<h1 class="center">รายงานข่าว</h1>
		<p class="center">รายงานข่าวประจําวันที่เริ่ม <b><?=$start?></b> ถึงวันที่ <b><?=$end?></b> หน่วยงาน <b><?=$this->xFunction->htmlspec($getData['department_name'])?></b> จํานวน <b><?=$total?></b> ข่าว</p>
		<table class="table table-striped items_list">
		  <thead>
		    <tr>
					<th width="10%" class="center">ลําดับที่</th>
					<th width="65%">หัวข้อข่าว/กิจกรรม</th>
		      <th width="15%">วันเวลาที่โพส</th>
					<th width="10%">ผู้โพส</th>
		    </tr>
		  </thead>
		  <tbody>
				<?php
					if(is_array($reportList)){
						if(count($reportList)>0){
							$no=1;
							foreach($reportList as $value){
				?>
		      <tr>
						<td class="center"><?=$no?></td>
						<td><?=$this->xFunction->htmlspec($value['title'])?><br />
						<i class="ace-icon fa fa-clock-o" aria-hidden="true"></i> <?=$this->xFunction->datetimeVIEW($value['news_start'])?></td>
		        <td><?=$this->xFunction->datetimeVIEW($value['create_at'])?></td>
						<td><?=$value['fullname']?></td>
		      </tr>
				<?php
						$no++;
							}
						}
					}else{ echo'<tr><td colspan="4" class="center">ไม่มีข้อมูล</td><tr>';}
				?>
		  </tbody>
		</table>
		<script type="text/javascript">
			 window.print();		
		</script>
</body>
</html>
