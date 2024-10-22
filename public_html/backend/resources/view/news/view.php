<?php
 if(!empty($getData['id'])){
  $galleryList=$this->model->getDataList(array("table"=>"gallery_tbl","field"=>"gallery_id as id,gallery_title as title,gallery_path as img_src","where"=>" news_id='".$_GET['id']."'","sort_by"=>"gallery_id ASC "));
  $filesList=$this->model->getDataList(array("table"=>"news_files_tbl","field"=>"news_files_id as id,news_files_title as title,news_files_path as files_src","where"=>" news_id='".$_GET['id']."'","sort_by"=>"news_files_id ASC "));
  if(!empty($getData['category'])){
   $getCategory=$this->model->getData(array("table"=>"category_tbl","field"=>"category_id as id,category_name as name","where"=>" category_id='".$getData['category']."'"));
  }
  if(!empty($getData['department'])){
    $check_department=$this->xFunction->stringOR('department_id',$getData['department']);
    $departmentList=$this->model->getDataList(array("table"=>"department_tbl","field"=>"department_id as id,department_name as name","where"=>$check_department,"sort_by"=>"department_id ASC "));
  }
?>
<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
          <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
  				<li><a href="javascript:void(0)"><?=$this->lang->menu->news?></a></li>
          <li><a href="<?=$callback?>"><?=$this->lang->module->news->list?></a></li>
          <li class="active"><?=$this->lang->page->news_view?></li>
        </ul>
    </div><!-- /.breadcrumbs -->
    <div class="page-content">
      <div class="col-xs-12">
        <div class="page-header">
         <h1><?=$this->lang->page->news_view?></h1>
        </div><!-- /.page-header -->
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                  <div class="profile-info-name"><?=$this->lang->label->id?> </div>
                  <div class="profile-info-value">
                    <span>
                      <?=$getData['id']?>
                    </span>
                  </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"><?=$this->lang->label->news_title?> </div>
                  <div class="profile-info-value">
                    <span><?=$this->xFunction->htmlspec($getData['title'])?></span>
                  </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"><?=$this->lang->label->news_category?> </div>
                  <div class="profile-info-value">
                    <span>
                      <?php if(!empty($getCategory['name'])){ ?>
                        <?=$this->xFunction->htmlspec($getCategory['name'])?>
                      <?php }?>
                    </span>
                  </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"><?=$this->lang->label->department?> </div>
                  <div class="profile-info-value">
                    <span>
                      <?php
                        if(is_array($departmentList)){
                          echo'<ul class="text_list">';
                          foreach($departmentList as $department){
                            echo '<li>'.$department["name"].'</li>';
                          }
                          echo'</ul>';
                        }//is_array
                      ?>
                    </span>
                  </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"><?=$this->lang->label->news_thumbnail?> </div>
                  <div class="profile-info-value">
                    <span>
                      <?php if(!empty($getData['thumbnail'])){ ?>
                        <div class="thumb_del">
                          <a href="<?=$this->mediaURL('news_thumbnail').$getData['thumbnail']?>" data-lity>
                            <img src="<?=$this->mediaURL('news_thumbnail').$getData['thumbnail']?>" width="200" />
                          </a>
                        </div>
                      <?php }?>
                    </span>
                  </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->overview?> </div>
                    <div class="profile-info-value">
                      <span>
                        <?=$this->xFunction->htmlspec($getData['overview'])?>
                      </span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->description?> </div>
                    <div class="profile-info-value">
                      <span>
                        <?=$this->xFunction->htmlspec($getData['description'])?>
                      </span>
                    </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"><?=$this->lang->label->gallery?> </div>
                  <div class="profile-info-value">
                    <span>
                      <?php
                        if(is_array($galleryList)){
                          echo'<ul class="ace-thumbnails clearfix" id="content_gallery">';
                          foreach($galleryList as $gallery){
                            $img_src=$this->mediaURL("gallery").$gallery["img_src"];
                            echo '<li class="center">';
                            echo '<a href="'.$img_src.'" title="'.$gallery["title"].'"><img src="'.$img_src.'" /></a>';
                            echo '</li>';
                          }
                            echo'</ul>';
                        }//is_array
                      ?>
                    </span>
                  </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"><?=$this->lang->label->attachment?> </div>
                  <div class="profile-info-value">
                    <span>
                      <ul class="attachment clearfix">
                       <?php
                         if(is_array($filesList)){
                           foreach($filesList as $attachment){
                             $attachment_src=$this->filesURL("news").$attachment["files_src"];
                             echo '<li>';
                             echo '<a href="'.$attachment_src.'" title="'.$attachment["title"].'">'.$attachment["files_src"].'</a>';
                             echo '</li>';
                           }
                         }//is_array
                       ?>
                      </ul>
                    </span>
                  </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"><?=$this->lang->label->link_youtube?> </div>
                  <div class="profile-info-value">
                    <span>
                      <?php if(!empty($getData['youtube'])){ echo '<a href="'.urldecode($getData['youtube']).'">'.urldecode($getData['youtube']).'</a>';} ?>
                    </span>
                  </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->sticky?> </div>
                    <div class="profile-info-value">
                      <span>
                        <?=$this->xFunction->checkICON($getData['sticky'])?>
                      </span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->date_start?> </div>
                    <div class="profile-info-value">
                      <span>
                        <?=$this->xFunction->datetimeVIEW($getData['news_start'])?>
                      </span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->date_end?> </div>
                    <div class="profile-info-value">
                      <span>
                        <?=$this->xFunction->datetimeVIEW($getData['news_end'])?>
                      </span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->status?> </div>
                    <div class="profile-info-value">
                      <span>
                       <?=$this->xFunction->checkSTATUS($getData['status'])?>
                      </span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->visit?> </div>
                    <div class="profile-info-value">
                      <span><?=number_format($getData['visit'])?> <?=$this->lang->label->nbcount?></span>
                    </div>
                </div>
                <?php if($getData['create_at']!='0000-00-00 00:00:00'){?>
                <div class="profile-info-row">
                    <div class="profile-info-name">วันที่โพสต์ข่าว </div>
                    <div class="profile-info-value">
                      <span><?=$this->xFunction->datetimeVIEW($getData['create_at'])?></span>
                    </div>
                </div>                
                <?php }?>
              </div><!--profile-user-info profile-user-info-striped-->
            </div><!--row-->
            <div class="clearfix form-actions">
              <a href="<?=$callback?>" class="btn pull-left" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <?=$this->lang->button->back?></a>
              <a href="<?=$this->baseurl->backend->module->news->manage.$getData['id'].$add_param?>" class="btn btn-info pull-right" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?=$this->lang->button->edit?></a>
              <div class="clearfix"></div>
            </div>
          </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
      </div><!-- /.col-xs-12 -->
    </div><!-- /.page-content -->
  </div><!-- /.main-content-inner -->
</div><!-- /.main-content -->
<link rel="stylesheet"  href="<?=$this->plugins?>lity/dist/lity.css" />
<script src="<?=$this->plugins?>lity/dist/lity.js" ></script>
<?php if(is_array($galleryList) && count($galleryList)>0){ ?>
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls"><div class="slides"></div><h3 class="title"></h3><a class="prev">‹</a><a class="next">›</a><a class="close">×</a><a class="play-pause"></a><ol class="indicator"></ol></div>
<link rel="stylesheet" href="<?=$this->plugins?>lightbox/css/blueimp-gallery.min.css">
<script src="<?=$this->plugins?>lightbox/js/blueimp-gallery.min.js"></script>
<script type="text/javascript">
  <!-- lightbox -->
  document.getElementById('content_gallery').onclick = function (event) {
      event = event || window.event;
      var target = event.target || event.srcElement,
          link = target.src ? target.parentNode : target,
          options = {index: link, event: event},
          links = this.getElementsByTagName('a');
      blueimp.Gallery(links, options);
  };
  <!-- lightbox -->
</script>
<?php }?>
<?php
 }else{
   $this->xFunction->pageReload($this->lang->alert->notify->error,$this->baseurl->dashboard);
 } //Check News
?>
