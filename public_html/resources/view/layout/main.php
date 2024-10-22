<script type="text/javascript">
jQuery(document).ready(function(){
	 $(".owl-theme .owl-nav").css("display", "none");
    $( "#preloader" ).delay(800).fadeOut(400, function(){
        $(".slider-active").css("display", "block");
		    $(".owl-theme .owl-nav").css("display", "block");
	 	    $("#preloader").css("display", "none");
    });
     $( "#preloader2" ).delay(800).fadeOut(400, function(){
         $(".slider-active").css("display", "block");
 		     $(".owl-theme .owl-nav").css("display", "block");
 	 	     $("#preloader2").css("display", "none");
     });
});
</script>
// 	<!-- Slider Area -->
		<section class="home-slider d-none d-md-block">
			<div id="preloader" class="textcenter"><i class="fa fa-spinner fa-spin"></i></div>
			<div class="slider-active" style="display:none;">
       <?php
		     if(is_array($slideList)){
			     foreach($slideList as $slider){
						 $slider_src='';
 						 if(!empty($slider['mb_slider'])){
 						  $slider_src ='style="background-image:url(\''.$this->mediaURL('banner').$slider['pc_slider'].'\')"';
 						 }else{
 						  $slider_src ='';
 						 }
				     $slider_html='';
				     $slider_html.='// 	<!-- Single Slider -->';
				     $slider_html.='<div class="single-slider overlay" '.$slider_src.' data-stellar-background-ratio="0.5">';
				     $slider_html.='<div class="container">';
				     $slider_html.='<div class="row">';
				     $slider_html.=$this->xFunction->htmlspec($slider['description']);
				     $slider_html.='</div>';
				     $slider_html.='</div>';
				     $slider_html.='</div>';
				     $slider_html.='<!--/ End Single Slider -->';
				     echo $slider_html;
			     }
		     }
			 ?>
			</div>
		</section>
		<section class="home-slider d-block d-md-none">
			<div id="preloader2" class="textcenter"><i class="fa fa-spinner fa-spin"></i></div>
			<div class="slider-active" style="display:none;">
       <?php
			  if(is_array($slideList)){
					foreach($slideList as $mbslider){
						$mbslider_src='';
						if(!empty($mbslider['mb_slider'])){
						 $mbslider_src ='style="background-image:url(\''.$this->mediaURL('banner').$mbslider['mb_slider'].'\')"';
						}else{
						 $mbslider_src ='';
						}
	          $mbslider_html='';
						$mbslider_html.='// 	<!-- Single Slider -->';
						$mbslider_html.='<div class="single-slider overlay" '.$mbslider_src.' data-stellar-background-ratio="0.5">';
						$mbslider_html.='<div class="container">';
						$mbslider_html.='<div class="row">';
						$mbslider_html.=$this->xFunction->htmlspec($mbslider['description']);
						$mbslider_html.='</div>';
						$mbslider_html.='</div>';
						$mbslider_html.='</div>';
						$mbslider_html.='<!--/ End Single Slider -->';
						echo $mbslider_html;
		      }
	      }
			 ?>
			</div>
		</section>
		<!--/ End Slider Area -->

		// 	<!-- Events -->
		<section class="events archives section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2><?=$this->lang->front->title->sticky?></h2>
						</div>
					</div>
				</div>
				<div class="row">
					<?php
					 if(is_array($stickyList)){
						 foreach($stickyList as $sticky){
							   $sticky_thumbnail='';
							   if(!empty($sticky['thumbnail'])){
					        $sticky_thumbnail =$this->mediaURL('news_thumbnail').$sticky['thumbnail'];
					       }else{
					        $sticky_thumbnail =$this->media.'img/default/no_images.jpg';
					       }
								 $sticky_html='';
                 $sticky_html.='<div class="col-lg-4 col-md-6 col-12">';
							   $sticky_html.='<div class="single-event">';
							   $sticky_html.='<div class="head overlay">';
							   $sticky_html.=$this->xFunction->check7DAYS($sticky['news_date']);
							   $sticky_html.='<img src="'.$sticky_thumbnail.'" alt="'.$this->xFunction->htmlspec($sticky['title']).'">';
							   $sticky_html.='<a href="'.$this->baseurl->front->module->news->detail.$sticky['id'].'" class="btn"><i class="fa fa-search"></i></a>';
							   $sticky_html.='</div>';
							   $sticky_html.='<div class="event-content">';
							   $sticky_html.='<div class="meta">';
							   $sticky_html.='<span><i class="fa fa-calendar"></i> '.$this->xFunction->thaidate($sticky['news_date']).'</span>';
							   $sticky_html.='<span><i class="fa fa-list-alt"></i> '.$this->xFunction->htmlspec($sticky['category_name']).'</span>';
							   $sticky_html.='</div>';
							   $sticky_html.='<h4><a href="'.$this->baseurl->front->module->news->detail.$sticky['id'].'">'.$this->xFunction->htmlspec($sticky['title']).'</a></h4>';
							   $sticky_html.='<p>'.$this->xFunction->htmlspec($sticky['overview']).'</p>';
							   $sticky_html.='<div class="button">';
							   $sticky_html.='<a href="'.$this->baseurl->front->module->news->detail.$sticky['id'].'" class="btn">'.$this->lang->label->read_more.'</a>';
							   $sticky_html.='</div></div></div></div>';
					       echo $sticky_html;
			 			    }
			 		    }
			 	    ?>
					</div><!--/ End row -->
				</div>
			</div>
		</section>
		<!--/ End Events -->
   <?php if(is_array($featuredList)){?>
		// 	<!-- Events -->
		<section class="events archives section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2><?=$this->lang->front->title->featured?> <span><?=$this->lang->front->title->today?></span></h2>
						</div>
					</div>
				</div>
				<div class="row">
					<?php
						 foreach($featuredList as $featured){
							   $featured_thumbnail='';
							   if(!empty($featured['thumbnail'])){
								  $featured_thumbnail =$this->mediaURL('news_thumbnail').$featured['thumbnail'];
							   }else{
								  $featured_thumbnail =$this->media.'img/default/no_images.jpg';
							   }
								 $featured_html='';
                 $featured_html.='<div class="col-lg-4 col-md-6 col-12">';
							   $featured_html.='<div class="single-event">';
							   $featured_html.='<div class="head overlay">';
							   $featured_html.=$this->xFunction->check7DAYS($featured['news_date']);
							   $featured_html.='<img src="'.$featured_thumbnail.'" alt="'.$this->xFunction->htmlspec($featured['title']).'">';
							   $featured_html.='<a href="'.$this->baseurl->front->module->news->detail.$featured['id'].'" class="btn"><i class="fa fa-search"></i></a>';
							   $featured_html.='</div>';
							   $featured_html.='<div class="event-content">';
							   $featured_html.='<div class="meta">';
							   $featured_html.='<span><i class="fa fa-calendar"></i> '.$this->xFunction->thaidate($featured['news_date']).'</span>';
							   $featured_html.='<span><i class="fa fa-list-alt"></i> '.$this->xFunction->htmlspec($featured['category_name']).'</span>';
							   $featured_html.='</div>';
							   $featured_html.='<h4><a href="'.$this->baseurl->front->module->news->detail.$featured['id'].'">'.$this->xFunction->htmlspec($featured['title']).'</a></h4>';
							   $featured_html.='<p>'.$this->xFunction->htmlspec($featured['overview']).'</p>';
							   $featured_html.='<div class="button">';
							   $featured_html.='<a href="'.$this->baseurl->front->module->news->detail.$featured['id'].'" class="btn">'.$this->lang->label->read_more.'</a>';
							   $featured_html.='</div></div></div></div>';
					       echo $featured_html;
			 			    }
			 	    ?>
					</div><!--/ End row -->
				</div>
			</div>
		</section>
		<!--/ End Events -->
	  <?php }?>
		// 	<!-- Events -->
		<section class="events section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2><?=$this->lang->front->title->included?> <span><?=$this->lang->front->title->lasted?></span></h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="event-slider">
							<?php
							 if(is_array($includedList)){
								 foreach($includedList as $newLasted){
									   $newLasted_thumbnail='';
								     if(!empty($newLasted['thumbnail'])){
									    $newLasted_thumbnail =$this->mediaURL('news_thumbnail').$newLasted['thumbnail'];
								     }else{
									    $newLasted_thumbnail =$this->media.'img/default/no_images.jpg';
								     }
										 $newLasted_html='';
									   $newLasted_html.='<div class="single-event">';
									   $newLasted_html.='<div class="head overlay">';
									   $newLasted_html.=$this->xFunction->check7DAYS($newLasted['news_date']);
									   $newLasted_html.='<img src="'.$newLasted_thumbnail.'" alt="'.$this->xFunction->htmlspec($newLasted['title']).'">';
									   $newLasted_html.='<a href="'.$this->baseurl->front->module->news->detail.$newLasted['id'].'" class="btn"><i class="fa fa-search"></i></a>';
									   $newLasted_html.='</div>';
									   $newLasted_html.='<div class="event-content">';
									   $newLasted_html.='<div class="meta">';
									   $newLasted_html.='<span><i class="fa fa-calendar"></i> '.$this->xFunction->thaidate($newLasted['news_date']).'</span>';
									   $newLasted_html.='<span><i class="fa fa-list-alt"></i> '.$this->xFunction->htmlspec($newLasted['category_name']).'</span>';
									   $newLasted_html.='</div>';
									   $newLasted_html.='<h4><a href="'.$this->baseurl->front->module->news->detail.$newLasted['id'].'">'.$this->xFunction->htmlspec($newLasted['title']).'</a></h4>';
									   $newLasted_html.='<p>'.$this->xFunction->htmlspec($newLasted['overview']).'</p>';
									   $newLasted_html.='<div class="button">';
									   $newLasted_html.='<a href="'.$this->baseurl->front->module->news->detail.$newLasted['id'].'" class="btn">'.$this->lang->label->read_more.'</a>';
									   $newLasted_html.='</div></div></div>';
							       echo $newLasted_html;
					 			    }
					 		    }
					 	    ?>
						</div><!--/ End event-slider -->
					</div>
				</div>
			</div>
		</section>
		<!--/ End Events -->

		// 	<!-- Blogs -->
		<section class="blog section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2><?=$this->lang->front->title->activity?> <span><?=$this->lang->front->title->included_lasted?></span></h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="blog-slider">

							<?php
 							if(is_array($activityList)){
 								$activity_thumbnail='';
 								foreach($activityList as $activity){
								    $count_visit='';
									  if($activity['visit']>0){ $count_visit='<a href="javascript:void(0)"><i class="fa fa-eye"></i> '.number_format($activity['visit']).' '.$this->lang->label->nbcount.'</a>';}else{ $count_visit=''; }
									  $activity_thumbnail='';
									  if(!empty($activity['thumbnail'])){
									   $activity_thumbnail =$this->mediaURL('news_thumbnail').$activity['thumbnail'];
									  }else{
									   $activity_thumbnail =$this->media.'img/default/no_images.jpg';
									  }
										$activity_html='';
 										$activity_html.='<div class="single-blog">';
 										$activity_html.='<div class="blog-head overlay">';
 										$activity_html.='<img src="'.$activity_thumbnail.'" alt="'.$this->xFunction->htmlspec($activity['title']).'">';
 										$activity_html.='</div>';
 										$activity_html.='<div class="blog-content">';
										$activity_html.='<h4 class="blog-title"><a href="'.$this->baseurl->front->module->news->detail.$activity['id'].'">'.$this->xFunction->htmlspec($activity['title']).'</a></h4>';
 										$activity_html.='<div class="blog-info">';
 										$activity_html.='<a href="javascript:void(0)"><i class="fa fa-calendar"></i> '.$this->xFunction->thaidate($activity['news_date']).'</a>';
 										$activity_html.=$count_visit;
 										$activity_html.='</div>';
 										$activity_html.='<p>'.$this->xFunction->htmlspec($activity['overview']).'</p>';
 										$activity_html.='<div class="button">';
 										$activity_html.='<a href="'.$this->baseurl->front->module->news->detail.$activity['id'].'" class="btn">'.$this->lang->label->read_more.' <i class="fa fa-angle-double-right"></i></a>';
 										$activity_html.='</div></div></div>';
 										echo $activity_html;
 									 }
 								 }
 							 ?>
						</div><!--/ End blog-slider -->
					</div>
				</div>
			</div>
		</section>
		<!--/ End Blogs -->
