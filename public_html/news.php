<?php
//if(isset($_GET['id']) && !empty($_GET['id'])){
  $var_id=15;
  error_reporting(0);
  @ini_set('display_errors', 0);
  $db='news';
  $con = mysqli_connect("localhost","aree","aree32");
  if (!$con){
    die('Could not connect: ' . mysqli_connect_error());
  }
  ?>
  <!DOCTYPE html>
  <html class="no-js" lang="zxx">
      <head>
      <!-- Title -->
    	<title>ข่าวประชาสัมพันธ์</title>
  		<!-- Meta -->
  		<meta charset="utf-8">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name='copyright' content="">
      <style>
      .clearfix{ clear: both;}
      .colum{ float:left; max-width: 25% !important;}
      .colum .items{ padding: 5px;}
      .colum .items img{ width:100%; display: inline-block;}
      p{ margin: 0; padding: 0;}
      p.title{ max-height: 40px; min-height: 40px; overflow: hidden;}
      a{ color: #069; text-decoration: none;}
      a:hover{ color:#222; text-decoration: underline;}
	  img {height: auto !important;}	  
      </style>
      </head>
      <body>
        <div class="container">
  <?php

  @mysql_db_query($db,"SET character_set_results=utf8");
  @mysql_db_query($db,"SET character_set_client = utf8");
  @mysql_db_query($db,"SET character_set_connection = utf8");

  $select = mysqli_query(" SELECT * FROM department_news_tbl a LEFT JOIN news_tbl b ON a.news_id=b.news_id WHERE a.department_id='".$var_id."' AND b.news_status='1' AND b.news_datetime_start<=NOW() AND b.news_datetime_end>=NOW() ORDER BY b.news_datetime_start DESC LIMIT 0,12 ");
  if(mysql_num_rows($select)>0){
    echo'<p>ข่าวประชาสัมพันธ์</p>';
    echo'<div class="row">';
    $i=1;
    while ($data = mysqli_fetch_array($select,MYSQL_ASSOC)){
      $news_thumbnail='';
      if(!empty($data['news_img_thumbnail_path'])){
       $news_thumbnail ='https://www.chanthaburi.buu.ac.th/~newsbuu/media/news/thumbnail/'.$data['news_img_thumbnail_path'];
      }else{
       $news_thumbnail ='https://www.chanthaburi.buu.ac.th/~newsbuu/media/img/default/no_images.jpg';
      }
      ?>
        <div class="colum">
          <a href="https://www.chanthaburi.buu.ac.th/~newsbuu/?select=news&m=detail&id=<?=$data['news_id']?>" target="_blank">
            <div class="items">
              <img src="<?=$news_thumbnail?>" alt="<?=$data['news_title']?>">
              <p class="title"><?=$data['news_title']?></p>
            </div>
          </a>
        </div>
      <?php
      $i++;
    }
    echo'</div>';
  }
  mysqli_close($con);
//}

?>
</div>
</body>
</html>
