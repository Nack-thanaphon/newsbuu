// 	<!-- Start Breadcrumbs -->
<?php
$breadcrumbs='';
if($this->data['web_config']['breadcrumbs']){
   $breadcrumbs=$this->mediaURL('breadcrumbs').$this->data['web_config']['breadcrumbs'];
}else{
 	 $breadcrumbs=$this->mediaURL('breadcrumbs').'default.jpg';
}
?>
<section class="breadcrumbs overlay" style="background-image:url('<?=$breadcrumbs?>')">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php if(!empty($department_name)){?><h2><?=$department_name?></h2><?php }?>
				<ul class="bread-list">
					<li><a href="<?=$this->baseurl->home?>"><?=$this->lang->front->home?><i class="fa fa-angle-right"></i></a></li>
					<li class="active"><a href="<?=$this->baseurl->front->module->news->category.$getNEWS['category_id']?>"><?=$this->xFunction->htmlspec($getNEWS['category_name'])?></a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!--/ End Breadcrumbs -->
// 	<!-- Events -->
<section class="events single section">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-12">
				<div class="single-event">
					 <?php
					 $news_photo ='';
					 if(is_array($galleryList)){
						 if(count($galleryList)>1){
						   $gallery_link='';
						   $gallery_html='';
						   $gallery_html.='<div class="event-gallery">';
							 foreach($galleryList as $gallery){
								$gallery_link=$this->mediaURL("gallery").$gallery['img_src'];
                $gallery_html.='<div class="single-gallery">';
								$gallery_html.='<img src="'.$gallery_link.'" alt="'.$gallery['title'].'">';
								$gallery_html.='</div>';
							 }
						   $gallery_html.='</div>';
						   echo $gallery_html;
						 }else{
							 foreach($galleryList as $gallery){
							   echo '<img src="'.$this->mediaURL("gallery").$gallery['img_src'].'" width="740" alt="'.$this->xFunction->htmlspec($getNEWS['title']).'">';
							 }
						 }
					 }else{
						 if(!empty($getNEWS['thumbnail'])){
							$news_photo =$this->mediaURL('news_thumbnail').$getNEWS['thumbnail'];
						 }else{
							$news_photo =$this->media.'img/default/no_photo.jpg';
						 }
						 echo '<img src="'.$news_photo.'" width="740" alt="'.$this->xFunction->htmlspec($getNEWS['title']).'">';
					 }
					 ?>
					// 	<!-- Gallery   End Gallery -->
					<div class="event-content">
						<div class="meta">
							<span><i class="fa fa-calendar"></i><?=$this->xFunction->thaidate($getNEWS['news_date'])?></span>
							<?=$count_visit?>
						</div>
						<h2><a href="<?=$newURL?>"><?=$this->xFunction->htmlspec($getNEWS['title'])?></a></h2>
						<p>
						<?=$this->xFunction->htmlspec($getNEWS['description'])?>
						</p>
           <?php
					  if(!empty($getNEWS['youtube'])){
							$youtube_html='';
							$youtube_html.='<p>';
							$youtube_html.='<div class="single-course">';
							$youtube_html.='<div class="course-head">';
							$youtube_html.='<div class="embed-responsive embed-responsive-16by9">';
							$youtube_html.='<iframe height="450" src="'.urldecode($getNEWS['youtube']).'"></iframe>';
							$youtube_html.='</div>';
							$youtube_html.='</div>';
							$youtube_html.='</div>';
							$youtube_html.='</p>';
							echo $youtube_html;
						}
					 	if(is_array($filesList)){
						  $files_link='';
						  $files_html='';
						  $files_html.='<div class="attachment">';
						  $files_html.='<span><i class="fa fa-paperclip"></i> เอกสารแนบ</span>';
					  	$files_html.='<ul>';
                foreach($filesList as $attachment){
                  $files_link=$this->filesURL("news").$attachment['files_src'];
                  $files_html.= '<li>';
                  $files_html.= '<a href="'.$files_link.'" target="_blank" title="'.$attachment["files_src"].'"><i class="fa fa-download"></i> '.$attachment["title"].'</a>';
                  $files_html.= '</li>';
                }
						  $files_html.='</ul>';
						  $files_html.='</div>';
						  echo $files_html;
            }
            if(!empty($getNEWS['fullname'])){
              echo'<p>ผู้ประกาศข่าว : <span class="blue">'.$getNEWS['fullname'].'</span></p>';
            }
						?>
						<div class="book-now">
							<ul class="social">
                                <li><div class="fb-share-button" data-href="<?=$newURL?>" data-layout="button_count"></div></li>
								<!--<li><?=$this->lang->button->share?> <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$newURL?>" target="_blank"><i class="fa fa-facebook"></i></a></li>-->
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-12">
				<div class="learnedu-sidebar">
					<div class="search">
							<form method="post" action="<?=$this->baseurl->front->module->news->list?>">
							  <div class="form">
								  <div class="form-row">
									  <div class="col-12 mt-2 mb-1 mt-md-1">
										  <input type="text" id="sdate" name="sdate"  class="form-control" placeholder="<?=$this->lang->placeholder->search_date?>">
									  </div>
									  <div class="col-12 mt-2 mb-1 mt-md-1">
										  <input type="text" name="q" id="q" class="form-control" placeholder="<?=$this->lang->placeholder->search_title?>">
										  <button class="button" type="submit"><i class="fa fa-search"></i></button>
									  </div>
								  </div>
							  </div>
						  </form>
					</div>
					// 	<!-- Categories -->
					<div class="single-widget categories">
							<h3 class="title"><?=$this->lang->front->newtype?></h3>
							<ul>
								<?php
									if(is_array($typeList)){
										foreach($typeList as $sbrType){
											echo '<li><a href="'.$this->baseurl->front->module->news->category.$sbrType['id'].'"><i class="fa fa-angle-right"></i> '.$this->xFunction->htmlspec($sbrType['name']).' <span>'.number_format($sbrType['total']).'</span></a></li>';
										}
									}
								?>
							</ul>
					</div>
					<!--/ End Categories -->
					<div class="single-widget course">
						<h3><?=$this->lang->front->newslist?> <span><?=$this->lang->front->title->lasted?></span></h3>
						// 	<!-- Single Course -->
						<?php
							if(is_array($newsLasted)){
								foreach($newsLasted as $sbrNews){
									$sbrnews_html='';
									$sbrnews_html.='<div class="single-course">';
									$sbrnews_html.='<div class="course-content">';
									$sbrnews_html.='<h4><a href="'.$this->baseurl->front->module->news->detail.$sbrNews['id'].'">'.$this->xFunction->htmlspec($sbrNews['title']).'</a></h4>';
									$sbrnews_html.='<div class="meta">';
									$sbrnews_html.='<span><i class="fa fa-calendar"></i>'.$this->xFunction->thaidate($sbrNews['news_date']).'</span>';
									$sbrnews_html.='</div>';
									$sbrnews_html.='</div>';
									$sbrnews_html.='</div>';
									echo $sbrnews_html;
								}
							}
						?>
						// 	<!-- Single Course -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ End Events -->
// 	<!-- Include Date Range Picker -->
<div id="fb-root"></div>
// 	<!-- Your share button code -->

<script src="<?=$this->plugins?>content/autocomplete_off.js" ></script>
<script type="text/javascript" src="<?=$this->assets?>vendor/datepicker/moment.min.js"></script>
<script type="text/javascript" src="<?=$this->assets?>vendor/datepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$this->assets?>vendor/datepicker/daterangepicker.css" />
<script type="text/javascript">
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
$(function() {
	$('input[name="sdate"]').daterangepicker({
		 opens: 'left',
		 autoUpdateInput: false,
		 locale: {
        format: 'DD/MM/YYYY',
				cancelLabel: 'Clear',
     }
  }).val('<?= $_REQUEST['sdate']?>');
	$('input[name="sdate"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });
	$('input[name="sdate"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
});
</script>
