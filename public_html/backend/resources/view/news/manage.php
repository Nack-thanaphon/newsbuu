<?php
 if(!empty($getData['id'])){
  $galleryList=$this->model->getDataList(array("table"=>"gallery_tbl","field"=>"gallery_id as id","where"=>" news_id='".$getData['id']."'","sort_by"=>"gallery_id ASC "));
  if($getData['news_start']=='0000-00-00 00:00:00'){$datetime_start=date('d/m/Y').' 08:30:00';}else{$datetime_start=$this->xFunction->datetimeVIEW($getData['news_start']);}
  if($getData['news_end']=='0000-00-00 00:00:00'){$datetime_end=date('d/m/Y').' 16:30:00';}else{$datetime_end=$this->xFunction->datetimeVIEW($getData['news_end']);}
?>
<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
          <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
  				<li><a href="javascript:void(0)"><?=$this->lang->menu->news?></a></li>
          <li><a href="<?=$callback?>"><?=$this->lang->module->news->list?></a></li>
          <li class="active"><?=$this->lang->page->news_manage?></li>
        </ul>
    </div>// 	<!-- /.breadcrumbs -->
    // 	<!-- /plugins -->
    <script src="<?=$this->plugins?>check/parsley_th.js" ></script>
    <link rel="stylesheet"  href="<?=$this->plugins?>check/parsley.css" />
    <script src="<?=$this->plugins?>check/form.js" ></script>
    <script src="<?=$this->plugins?>content/autocomplete_off.js" ></script>
    // 	<!-- /plugins -->
    <div class="page-content">
      <div class="col-xs-12">
        <div class="page-header">
         <h1><?=$this->lang->page->news_manage?></h1>
        </div>// 	<!-- /.page-header -->
        <div class="row">
          <div class="col-md-6">
          	<form id="frm" name="frm" class="form-horizontal" role="form" method="post" action=""  data-parsley-validate=""  enctype="multipart/form-data">
              <div class="row">
                <div class="profile-user-info profile-user-info-striped">
                  <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->id?> </div>
                    <div class="profile-info-value">
                      <span>
                        <input type="text" id="news_id" name="news_id" value="<?=$getData['id']?>" readonly />
                      </span>
                    </div>
                  </div>
                  <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->news_title?> </div>
                    <div class="profile-info-value">
                      <span>
                        <input type="text" id="news_title" name="news_title" value="<?=$this->xFunction->htmlspec($getData['title'])?>" class="form-control" required="" />
                      </span>
                    </div>
                  </div>
                  <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->news_category?> </div>
                    <div class="profile-info-value">
                      <span>
                        <select id="news_category" name="news_category" class="form-control select2"  required="">
                           <option value=""><?=$this->lang->label->select?></option>
                           <?php
							                if(is_array($categoryList)){
							                	foreach($categoryList as $category){
                                  if($getData['category']==$category['id']){
                                    echo'<option value="'.$category['id'].'" selected="selected">'.$this->xFunction->htmlspec($category['name']).'</option>';
                                  }else{
                                    echo'<option value="'.$category['id'].'">'.$this->xFunction->htmlspec($category['name']).'</option>';
                                  }
                                }
                             }
                            ?>
                        </select>
                      </span>
                    </div>
                  </div>
                  <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->department?> </div>
                    <div class="profile-info-value">
                      <span>
                        <select id="news_department" name="news_department" class="col-xs-12" multiple="multiple" required="">
                          <?php
                             if(is_array($departmentList)){
                               foreach($departmentList as $department){
                                 echo'<option value="'.$department['id'].'">'.$this->xFunction->htmlspec($department['name']).'</option>';
                               }
                            }
                           ?>
                        </select>
                        <?=$this->xFunction->placeholder('multi_select','span')?>
                      </span>
                    </div>
                  </div>
                  <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->news_thumbnail?> </div>
                    <div class="profile-info-value">
                      <span>
                        <div id="show_thumbnail"></div>
                        <?php if(!empty($getData['thumbnail'])){ ?>
                          <div class="thumb_del">
                            <a href="<?=$this->mediaURL('news_thumbnail').$getData['thumbnail']?>" data-lity>
                              <img src="<?=$this->mediaURL('news_thumbnail').$getData['thumbnail']?>" width="200" />
                            </a><br />
                            <label class="label_del"><input id="del_images" name="del_images" type="checkbox" value="1" /> <?=$this->lang->label->delete?></label>
                          </div>
                        <?php }else{ ?>
                          <input id="del_images" name="del_images" type="hidden" value="0" />
                        <?php }?>
                        <a class="btn btn-sm btn-info pull-left" href="#modal-thumbnail-crop" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="fa fa-upload" aria-hidden="true"></i> <?=$this->lang->action->upload?></a>
                      </span>
                    </div>
                  </div>
                  <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->overview?> </div>
                    <div class="profile-info-value">
                      <span>
                          <textarea id="news_overview" name="news_overview" cols="50" class="input_textarea" rows="2"><?=$this->xFunction->htmlspec($getData['overview'])?></textarea>
                      </span>
                    </div>
                  </div>
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->description?> </div>
                      <div class="profile-info-value">
                        <span>
                          <textarea id="news_description" name="news_description" cols="50" class="form-control" rows="4"><?=$this->xFunction->htmlspec($getData['description'])?></textarea>
                        </span>
                      </div>
                  </div>
                  <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->gallery?> </div>
                    <div class="profile-info-value">
                      <span>
                        <ul class="ace-thumbnails clearfix" id="content_gallery"></ul>
                        <a class="btn btn-sm btn-info pull-left" href="#modal-upload" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="fa fa-image" aria-hidden="true"></i> <?=$this->lang->action->upload?></a>
                        <div class="clearfix"></div>
                      </span>
                    </div>
                  </div>
                  <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->attachment?> </div>
                    <div class="profile-info-value">
                      <span>
                        <ul class="attachment clearfix" id="content_attachment"></ul>
                        <a class="btn btn-sm btn-info pull-left" href="#modal-upload-files" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="fa fa-file-text-o" aria-hidden="true"></i> <?=$this->lang->action->upload?></a>
                        <div class="clearfix"></div>
                      </span>
                    </div>
                  </div>
                  <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->link_youtube?>  </div>
                    <div class="profile-info-value">
                      <span>
                        <input type="text" id="news_youtube" name="news_youtube" value="<?=urldecode($getData['youtube'])?>" class="form-control" />
                      </span>
                    </div>
                  </div>
                  <?php  if($this->checkUID('level')==9){?>
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->sticky?> </div>
                      <div class="profile-info-value">
                        <span>
                          <input type="checkbox" class="switcher" id="news_sticky" name="news_sticky" <?php if($getData['sticky']=='1'){ echo 'checked="checked"';}?> value="1">
                        </span>
                      </div>
                  </div>
                  <?php  }?>
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->date_start?> </div>
                      <div class="profile-info-value">
                        <span>
                          <div class="input-group">
														<input id="news_start" name="news_start" type="text" value="<?=$datetime_start?>" class="form-control" required="" />
													</div>
                        </span>
                      </div>
                  </div>
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->date_end?> </div>
                      <div class="profile-info-value">
                        <span>
                          <div class="input-group">
														<input id="news_end" name="news_end" type="text" value="<?=$datetime_end?>" class="form-control" required="" />
													</div>
                        </span>
                      </div>
                  </div>
                  <?php  if($this->checkUID('level')==9){?>
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->status?> </div>
                      <div class="profile-info-value">
                        <span>
                         <input type="checkbox" class="switcher" id="news_status" name="news_status" <?php if($getData['status']=='1'){ echo 'checked="checked"';}?> value="1">
                        </span>
                      </div>
                  </div>
                <?php  }?>
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
              <!--AJAX Message-->
              <div id="message"></div>
              <!--AJAX Message-->
              <div class="clearfix form-actions">
                <a href="<?=$callback?>" class="btn pull-left" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <?=$this->lang->button->back?></a>
                <button class="btn btn-info pull-right"  type="submit" id="loading"><i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?></button>
                <div class="clearfix"></div>
              </div>
            </form><!--form-->
          </div>// 	<!-- /.col-md-6 -->
          <div class="col-md-6 news_image_all">
            <h2><?=$this->lang->page->news_images?></h2>
            <form method="post" name="multiple_news_images" id="multiple_news_images" enctype="multipart/form-data" action="<?=$this->baseurl->backend->process?>">
              <div class="form-group">
                <label class="fonts_blue"><?=$this->lang->label->upload?> :</label>
                <label class="ace-file-input">
                	  <input type="file" name="news_images[]" id="news_images" multiple>
                    <span class="ace-file-container" data-title="<?=$this->lang->label->select?>">
                      <span class="ace-file-name" data-title="...">
                        <i class="ace-icon fa fa-upload"></i>
                      </span>
                    </span>
                </label>
                <?=$this->xFunction->placeholder('images_extensions','span')?><br />
              	<span class="images_loading none"><i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...</span>
                <div class="clearfix"></div>
              </div>
              <!--AJAX Message-->
              <div id="show_message"></div>
              <!--AJAX Message-->
              <input type="hidden" name="news_images_submit" value="1"/>
              <input type="hidden" id="module" name="module" value="News"/>
              <input type="hidden" id="action" name="action" value="upload-news-images"/>
              <input type="hidden" name="refresh" value="0"/>
            </form>
            <ul class="ace-thumbnails clearfix" id="loading_news_images"></ul>
          </div>// 	<!-- /.col-md-6 -->
          <div class="clearfix"></div>
        </div>// 	<!-- /.row -->
      </div>// 	<!-- /.col-sm-10 col-sm-offset-1 -->
    </div>// 	<!-- /.page-content -->
  </div>// 	<!-- /.main-content-inner -->
</div>// 	<!-- /.main-content -->

<!--Edit thumbnail Form-->
<div id="modal-thumbnail-crop" class="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="efrm" name="efrm" class="form-horizontal" role="form" method="post" action=""  data-parsley-validate="" enctype="multipart/form-data">
        <div id="modal-wizard-container">
          <div class="modal-header"><h3><?=$this->lang->page->news_thumbnail?></h3></div>
          <div class="modal-body step-content image-editor">
            <div class="form-group">
              <label class="col-xs-12"><?=$this->lang->label->select_photo?></label>
              <div class="col-xs-12">
                 <input type="file" id="news_thumbnail" name="news_thumbnail" class="cropit-image-input">
                 <?=$this->xFunction->placeholder('news_thumbnail','span')?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12"><?=$this->lang->label->ex_photo?></label>
              <div class="col-xs-12">
                 <div class="cropit-preview"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12"><?=$this->lang->label->adjust_image?></label>
              <div class="col-xs-12">
                <input type="range" class="cropit-image-zoom-input"><br />
                <a href="javascript:void(0)" class="btn rotate-cw"><i class="ace-icon fa fa-rotate-right" aria-hidden="true"></i> <?=$this->lang->label->rotate_cw?></a>
                <a href="javascript:void(0)" class="btn rotate-ccw"><i class="ace-icon fa fa-rotate-left" aria-hidden="true"></i> <?=$this->lang->label->rotate_ccw?></a>
              </div>
            </div>
          </div><!--modal-body step-content-->
        </div><!--modal-wizard-container-->
        <div class="modal-footer wizard-actions">
          <input type="hidden" name="image-data" class="hidden-image-data" />
          <button class="btn btn-success btn-sm btn-next" data-last="Finish" id="eloading">
          <i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>
          </button>
          <button class="btn btn-sm pull-left" data-dismiss="modal" id="eclose-modal">
          <i class="ace-icon fa fa-times"></i> <?=$this->lang->button->close?>
          </button>
        </div><!--modal-footer wizard-actions-->
      </form>
    </div><!--modal-content-->
  </div>  <!--modal-dialog-->
</div><!--modal-wizard-->
<!--Edit thumbnail Form-->
<!--Upload Img FORM-->
<div id="modal-upload" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data" action="<?=$this->baseurl->backend->process?>">
      	<div id="modal-wizard-container">
          <div class="modal-header">
            <h3><?=$this->lang->page->news_gallery?></h3>
          </div>
          <div class="modal-body step-content">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" >
                <?=$this->lang->label->upload_img?>
              </label>
              <div class="col-sm-9">
                <label class="ace-file-input" >
                	 <input type="file" name="images[]" id="images" multiple >
                     <span class="ace-file-container" data-title="<?=$this->lang->label->select?>">
                         <span class="ace-file-name" data-title="...">
                             <i class=" ace-icon fa fa-upload"></i>
                         </span>
                     </span>
                 </label>
                 <?=$this->xFunction->placeholder('news_gallery','span')?><br />
              	 <span class="uploading none"><i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...</span>
              </div>
              <div class="clearfix"></div>
            </div>
          </div><!--modal-body step-content-->
         </div><!--modal-wizard-container-->
         <div class="modal-footer wizard-actions">
           <!--AJAX Message-->
           <div id="imessage"></div>
           <!--AJAX Message-->
       	   <input type="hidden" name="image_form_submit" value="1"/>
           <input type="hidden" id="module" name="module" value="News"/>
           <input type="hidden" id="action" name="action" value="upload-gallery"/>
           <input id="img_upload_id" name="img_upload_id" type="hidden" value="<?=$getData['id']?>" />
         	 <button class="btn btn-sm pull-left" data-dismiss="modal" id="close-modal"><i class="ace-icon fa fa-times"></i> <?=$this->lang->button->close?></button>
           <a href="#modal-images-manage" onclick="load_manage_gallery(<?=$getData['id']?>); click_close_modal('close-modal');" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="ace-icon fa fa-pencil-square-o"></i><?=$this->lang->action->edit?></a>
           <div class="clearfix"></div>
        </div>
      </form>
    </div><!--modal-content-->
  </div> <!--modal-dialog-->
</div><!--modal-wizard-->
<!--Upload Img FORM-->
<link rel="stylesheet"  href="<?=$this->plugins?>table/responsive.css" />
<!--Manage Img Form-->
<div id="modal-images-manage" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="sfrm" name="sfrm" class="form-horizontal" role="form" method="post" action=""  data-parsley-validate="">
        <div id="modal-wizard-container">
          <div class="modal-header"><h3 ><?=$this->lang->page->news_manage_gallery?></h3></div>
          <div class="modal-body step-content">
            <div id="manage_gallery"></div>
            <div class="button_popup">
             <a class="btn btn-sm btn-info pull-left" onclick="click_close_modal('sclose-modal');" href="#modal-upload" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="fa fa-image" aria-hidden="true"></i> <?=$this->lang->action->upload?></a>
             <a href="javascript:void(0)" id="select_items"  class="btn btn-sm pull-right" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="ace-icon fa fa-check-square-o"></i><?=$this->lang->action->delete_selected?></a>
             <div class="clearfix"></div>
            </div>
          </div><!--modal-body step-content-->
        </div><!--modal-wizard-container-->
        <div class="modal-footer wizard-actions">
          <!--AJAX Message-->
          <div id="smessage"></div>
          <!--AJAX Message-->
          <input id="images_news_id" name="images_news_id" type="hidden" value="<?=$getData['id']?>" />
          <button class="btn btn-success btn-sm btn-next" data-last="Finish" id="sloading">
          <i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>
          </button>
          <button class="btn btn-sm pull-left" data-dismiss="modal" id="sclose-modal">
          <i class="ace-icon fa fa-times"></i> <?=$this->lang->button->close?>
          </button>
        </div><!--modal-footer wizard-actions-->
      </form>
    </div><!--modal-content-->
  </div>  <!--modal-dialog-->
</div><!--modal-wizard-->
<!--Manage Img Form-->
<!--Upload files FORM-->
<div id="modal-upload-files" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" name="multiple_upload_files" id="multiple_upload_files" enctype="multipart/form-data" action="<?=$this->baseurl->backend->process?>">
      	<div id="modal-wizard-container">
          <div class="modal-header">
            <h3><?=$this->lang->page->attachment?></h3>
          </div>
          <div class="modal-body step-content">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" >
                <?=$this->lang->label->upload_files?>
              </label>
              <div class="col-sm-9">
                <label class="ace-file-input" >
                	 <input type="file" name="files[]" id="files" multiple >
                     <span class="ace-file-container" data-title="<?=$this->lang->label->select?>">
                         <span class="ace-file-name" data-title="...">
                             <i class="ace-icon fa fa-upload"></i>
                         </span>
                     </span>
                 </label>
                 <?=$this->xFunction->placeholder('files_extensions','span')?><br />
              	 <span class="files_uploading none"><i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...</span>
              </div>
              <div class="clearfix"></div>
            </div>
          </div><!--modal-body step-content-->
         </div><!--modal-wizard-container-->
         <div class="modal-footer wizard-actions">
           <!--AJAX Message-->
           <div id="fmessage"></div>
           <!--AJAX Message-->
       	   <input type="hidden" name="files_form_submit" value="1"/>
           <input type="hidden" id="module" name="module" value="News"/>
           <input type="hidden" id="action" name="action" value="upload-attachment"/>
           <input id="files_upload_id" name="files_upload_id" type="hidden" value="<?=$getData['id']?>" />
         	 <button class="btn btn-sm pull-left" data-dismiss="modal" id="fclose-modal">
             <i class="ace-icon fa fa-times"></i> <?=$this->lang->button->close?>
           </button>
           <a href="#modal-files-manage" onclick="load_manage_attachment(<?=$getData['id']?>); click_close_modal('fclose-modal');" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="ace-icon fa fa-pencil-square-o"></i><?=$this->lang->action->edit?></a>
           <div class="clearfix"></div>
        </div>
      </form>
    </div><!--modal-content-->
  </div> <!--modal-dialog-->
</div><!--modal-wizard-->
<!--Upload files FORM-->
<!--Manage files Form-->
<div id="modal-files-manage" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="zfrm" name="zfrm" class="form-horizontal" role="form" method="post" action=""  data-parsley-validate="">
        <div id="modal-wizard-container">
          <div class="modal-header">
            <h3><?=$this->lang->page->news_manage_attachment?></h3>
          </div>
          <div class="modal-body step-content">
            <div id="manage_attachment"></div>
            <div class="button_popup">
             <a class="btn btn-sm btn-info pull-left" onclick="click_close_modal('zclose-modal');" href="#modal-upload-files" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="fa fa-file-text-o" aria-hidden="true"></i> <?=$this->lang->action->upload?></a>
             <a href="javascript:void(0)" id="select_files_items"  class="btn btn-sm pull-right" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="ace-icon fa fa-check-square-o"></i><?=$this->lang->action->delete_selected?></a>
             <div class="clearfix"></div>
            </div>
          </div><!--modal-body step-content-->
        </div><!--modal-wizard-container-->
        <div class="modal-footer wizard-actions">
          <!--AJAX Message-->
          <div id="zmessage"></div>
          <!--AJAX Message-->
          <input id="files_news_id" name="files_news_id" type="hidden" value="<?=$getData['id']?>" />
          <button class="btn btn-success btn-sm btn-next" data-last="Finish" id="zloading">
          <i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>
          </button>
          <button class="btn btn-sm pull-left" data-dismiss="modal" id="zclose-modal">
          <i class="ace-icon fa fa-times"></i> <?=$this->lang->button->close?>
          </button>
        </div><!--modal-footer wizard-actions-->
      </form>
    </div><!--modal-content-->
  </div>  <!--modal-dialog-->
</div><!--modal-wizard-->
<!--modal-open-images-->
<div id="modal-open-images" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="images_frm" name="images_frm" class="form-horizontal" role="form" method="post" action="" onsubmit="return edit_images_title()">
        <div id="modal-wizard-container">
          <div class="modal-header"><h3><?=$this->lang->page->news_images_data?></h3></div>
          <div class="modal-body step-content">
           <span id="load_form_images"></span>
          </div><!--modal-body step-content-->
        </div><!--modal-wizard-container-->
        <div class="modal-footer wizard-actions">
          <!--AJAX Message-->
          <div id="xmessage"></div>
          <!--AJAX Message-->
          <button class="btn btn-sm btn-next" data-dismiss="modal" id="xclose-modal" type="button">
          <i class="ace-icon fa fa-times"></i> <?=$this->lang->button->close?>
          </button>
          <input type="submit" class="none" />
          <div class="clearfix"></div>
        </div><!--modal-footer wizard-actions-->
      </form>
    </div><!--modal-content-->
  </div>  <!--modal-dialog-->
</div><!--modal-wizard-->
<script src="<?=$this->plugins?>clipboard/clipboard.min.js" ></script>
<script type="text/javascript">
		var clipboard = new Clipboard('.copy');
		clipboard.on('success', function(e) {
      $(e.trigger).html("<span class=\"in_span\"><?=$this->lang->alert->success->copied?></span>");
      e.clearSelection();
      setTimeout(function() {
        $(e.trigger).html("<i class=\"fa fa-copy blue\"></i> <?=$this->lang->action->btn_copy?>");
      }, 2500);
		});
		clipboard.on('error', function(e) {
			alert('Error!');
		});
</script>
<!--modal-open-images-->
<!--Manage files Form-->
<link rel="stylesheet" href="<?=$this->_assets?>css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="<?=$this->_assets?>css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="<?=$this->_assets?>css/daterangepicker.min.css" />
<link rel="stylesheet" href="<?=$this->_assets?>css/bootstrap-datetimepicker.min.css" />
<script src="<?=$this->_assets?>js/bootbox.js"></script>
<script src="<?=$this->_assets?>js/bootstrap-datepicker.min.js"></script>
<script src="<?=$this->_assets?>js/bootstrap-timepicker.min.js"></script>
<script src="<?=$this->_assets?>js/moment.min.js"></script>
<script src="<?=$this->_assets?>js/daterangepicker.min.js"></script>
<script src="<?=$this->_assets?>js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet"  href="<?=$this->plugins?>lity/dist/lity.css" />
<script src="<?=$this->plugins?>lity/dist/lity.js" ></script>
<script src="<?=$this->plugins?>ckeditor/ckeditor.js" ></script>
<script src="<?=$this->plugins?>ckeditor/config.js" ></script>
<link href="<?=$this->plugins?>switcher/css/switcher.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->plugins?>switcher/js/jquery.switcher.js"></script>
<link rel="stylesheet" href="<?=$this->_assets?>css/select2.min.css" />
<script src="<?=$this->_assets?>js/select2.min.js"></script>
<script src="<?=$this->plugins?>crop/js/jquery.cropit.js" ></script>
<script src="<?=$this->plugins?>upload_multiple/js/jquery.form.js"></script>
<?php if(is_array($galleryList) && count($galleryList)>0){ ?>
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls"><div class="slides"></div><h3 class="title"></h3><a class="prev">‹</a><a class="next">›</a><a class="close">×</a><a class="play-pause"></a><ol class="indicator"></ol></div>
<link rel="stylesheet" href="<?=$this->plugins?>lightbox/css/blueimp-gallery.min.css">
<script src="<?=$this->plugins?>lightbox/js/blueimp-gallery.min.js"></script>
<script type="text/javascript">
  // 	<!-- lightbox -->
  document.getElementById('content_gallery').onclick = function (event) {
      event = event || window.event;
      var target = event.target || event.srcElement,
          link = target.src ? target.parentNode : target,
          options = {index: link, event: event},
          links = this.getElementsByTagName('a');
      blueimp.Gallery(links, options);
  };
  // 	<!-- lightbox -->
</script>
<?php }?>
<script type="text/javascript">
  function click_close_modal(id){ $("#"+id).click(); }
  /*Function edit_images_title*/
  function edit_images_title(){
    var id= $("#images_id").val();
    var name= $("#images_name").val();
    $("#load_images_title").html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
    $.ajax({
     url : "<?=$this->baseurl->backend->process?>",
     type: "POST",
     data : {module:'News',action:'edit-images-title',images_id:id,images_name:name,refresh:0},
     success: function(data, textStatus, jqXHR){
       if(textStatus=='success'){
         $("#xmessage").html(data);
         $("#load_images_title").html('<i class="fa fa-edit bigger-110"></i> <?=$this->lang->action->edit?>');
       }
     },error: function (jqXHR, textStatus, errorThrown){
       alert('Error!');
       window.location.reload();
     }
    });
    return false;
  }
  /*Function edit_images_title*/
  /*Function load_gallery*/
  function load_gallery(id){
    $("#content_gallery").html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
    $.ajax({
     url : "<?=$this->baseurl->backend->loading?>",
     type: "POST",
     data : {module:'News',load:'load-gallery',news_id:id},
     success: function(data, textStatus, jqXHR){
       if(textStatus=='success'){$( "#content_gallery" ).html(data);}
     },error: function (jqXHR, textStatus, errorThrown){
       alert('Error!');
       window.location.reload();
     }
    });
  }
  /*Function load_gallery*/
  /*Function load_manage_gallery*/
  function load_manage_gallery(id){
    $("#manage_gallery").html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
    $.ajax({
     url : "<?=$this->baseurl->backend->loading?>",
     type: "POST",
     data : {module:'News',load:'manage-gallery',news_id:id},
     success: function(data, textStatus, jqXHR){
       if(textStatus=='success'){$( "#manage_gallery" ).html(data);}
     },error: function (jqXHR, textStatus, errorThrown){
       alert('Error!');
       window.location.reload();
     }
    });
  }
  /*Function load_manage_gallery*/
  /*Function load_attachment*/
  function load_attachment(id){
    $("#content_attachment").html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
    $.ajax({
     url : "<?=$this->baseurl->backend->loading?>",
     type: "POST",
     data : {module:'News',load:'load-attachment',news_id:id},
     success: function(data, textStatus, jqXHR){
       if(textStatus=='success'){$( "#content_attachment" ).html(data);}
     },error: function (jqXHR, textStatus, errorThrown){
       alert('Error!');
       window.location.reload();
     }
    });
  }
  /*Function load_attachment*/
  /*Function load_manage_attachment*/
  function load_manage_attachment(id){
    $("#manage_attachment").html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
    $.ajax({
     url : "<?=$this->baseurl->backend->loading?>",
     type: "POST",
     data : {module:'News',load:'manage-attachment',news_id:id},
     success: function(data, textStatus, jqXHR){
       if(textStatus=='success'){$( "#manage_attachment" ).html(data);}
     },error: function (jqXHR, textStatus, errorThrown){
       alert('Error!');
       window.location.reload();
     }
    });
  }
  /*Function load_manage_attachment*/
  /*Function load_gallery*/
  function load_news_images(){
    $("#loading_news_images").html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
    $.ajax({
     url : "<?=$this->baseurl->backend->loading?>",
     type: "POST",
     data : {module:'News',load:'load-news-images'},
     success: function(data, textStatus, jqXHR){
       if(textStatus=='success'){$( "#loading_news_images" ).html(data);}
     },error: function (jqXHR, textStatus, errorThrown){
       alert('Error!');
       window.location.reload();
     }
    });
  }
  /*Function load_news_images*/
  /*Function load_gallery*/
  function load_form_images(id){
    $("#load_form_images").html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
    $.ajax({
     url : "<?=$this->baseurl->backend->loading?>",
     type: "POST",
     data : {module:'News',load:'form-news-images',images_id:id},
     success: function(data, textStatus, jqXHR){
       if(textStatus=='success'){$( "#load_form_images" ).html(data);}
     },error: function (jqXHR, textStatus, errorThrown){
       alert('Error!');
       window.location.reload();
     }
    });
  }
  /*Function load_news_images*/
  $(document).ready(function () {
    load_gallery(<?=$getData['id']?>); /*Load load_gallery*/
    load_manage_gallery(<?=$getData['id']?>); /*Load load_manage_gallery*/
    load_attachment(<?=$getData['id']?>); /*Load load_attachment*/
    load_manage_attachment(<?=$getData['id']?>); /*Load load_manage_attachment*/
    load_news_images(); /*Load load_news_images*/
    /* Upload Images & Files */
    $('#news_images').on('change',function(){
     var files = $(this)[0].files;
     if(files.length > 20){
       alert("<?=$this->lang->alert->notify->limit_select_images?>");
     }else{
		   $('#multiple_news_images').ajaxForm({
			   target:'#show_message',
			   beforeSubmit:function(e){
				   $('.images_loading').show();
			   },
			   success:function(e){
				   $('.images_loading').hide();
			   },
			   error:function(e){
			   }
		   }).submit();
     }
	  });
	  $('#images').on('change',function(){
      var files = $(this)[0].files;
      if(files.length > 20){
        alert("<?=$this->lang->alert->notify->limit_select_images?>");
      }else{
		    $('#multiple_upload_form').ajaxForm({
			    target:'#imessage',
			    beforeSubmit:function(e){
				    $('.uploading').show();
			    },
			    success:function(e){
				    $('.uploading').hide();
			    },
			    error:function(e){
			    }
		    }).submit();
      }
	  });
    $('#files').on('change',function(){
      var files = $(this)[0].files;
      if(files.length > 20){
        alert("<?=$this->lang->alert->notify->limit_select_files?>");
      }else{
		   $('#multiple_upload_files').ajaxForm({
			   target:'#fmessage',
			   beforeSubmit:function(e){
				   $('.files_uploading').show();
			   },
			   success:function(e){
				   $('.files_uploading').hide();
			   },
			   error:function(e){
			   }
		   }).submit();
     }
	  });
    /* Upload Images & Files */
    // Check width IMG
    var _URL = window.URL;
    $("#news_thumbnail").change(function (e) {
      var file, img;
      if ((file = this.files[0])) {
        img = new Image();
        img.onload = function () {
            if(this.width<740 || this.height<493){
              alert("<?=$this->lang->alert->notify->check_news_thumbnail?>");
              $("#news_thumbnail").val('');
            }
        };
        img.src = _URL.createObjectURL(file);
      }
    });
    // Check width IMG
  });//document ready
  <?php	if(!empty($getData['department'])){	?>
	    var department="<?=$getData['department']?>";
	    $.each(department.split(","), function(i,e){ $("#news_department option[value='" + e + "']").prop("selected", true); });
	<?php	}?>
    jQuery(function($) {
      if(!ace.vars['old_ie'])
        $('#news_start').datetimepicker({
			    format: 'DD/MM/YYYY H:mm:ss',
			    icons: {
			      time: 'fa fa-clock-o',
				    date: 'fa fa-calendar',
				    up: 'fa fa-chevron-up',
				    down: 'fa fa-chevron-down',
				    previous: 'fa fa-chevron-left',
				    next: 'fa fa-chevron-right',
				    today: 'fa fa-arrows ',
				    clear: 'fa fa-trash',
				    close: 'fa fa-times'
			    }
		    }).next().on(ace.click_event, function(){	$(this).prev().focus(); });
        $('#news_end').datetimepicker({
			    format: 'DD/MM/YYYY H:mm:ss',
			    icons: {
			      time: 'fa fa-clock-o',
				    date: 'fa fa-calendar',
			    up: 'fa fa-chevron-up',
				    down: 'fa fa-chevron-down',
				    previous: 'fa fa-chevron-left',
				    next: 'fa fa-chevron-right',
				  today: 'fa fa-arrows ',
				  clear: 'fa fa-trash',
				  close: 'fa fa-times'
			  }
		  }).next().on(ace.click_event, function(){	$(this).prev().focus(); });
    });
    $(function() {
        $('.image-editor').cropit();
        $('.rotate-cw').click(function() { $('.image-editor').cropit('rotateCW'); });
        $('.rotate-ccw').click(function() { $('.image-editor').cropit('rotateCCW'); });
        $('#efrm').submit(function() {
        var imageData = $('.image-editor').cropit('export');
        $('.hidden-image-data').val(imageData);
        var formData = new FormData();
        formData.append('module', 'News');
        formData.append('action', 'save-thumbnail');
        formData.append('id',$("#news_id").val());
        formData.append('thumbnail', imageData);
		    $.ajax({
			     url : "<?=$this->baseurl->backend->process?>",
			     type: "POST",
			     contentType: false,
			     processData: false,
			     data : formData,
		      success: function(data, textStatus, jqXHR)
			    {
				   if(textStatus=='success'){$( "#show_thumbnail" ).html(data);}
			    },
			    error: function (jqXHR, textStatus, errorThrown)
			   {
				   alert('Error!');
				   location.reload();
			   }
			});
      return false;
    });
    $("#select_items").on('click', function() {
      var strChoices = "";
      var objCBarray = document.getElementsByName('items');
      var id = $("#images_news_id").val()
      var numbers = new Array();
      for (i = 0; i < objCBarray.length; i++) {
      if (objCBarray[i].checked) {
        numbers[i]=objCBarray[i].value;
        strChoices += "" + objCBarray[i].value + "<br />";
      }
      }
      if (strChoices.length > 0) {
        $("#sloading").html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
        bootbox.confirm({
            message: "<?=$this->lang->alert->confirm->delete_all?><br />"+strChoices,
            buttons: {
              confirm: { label: "<?=$this->lang->button->confirm?>",className: "btn-primary btn-sm",},
              cancel: {	 label: "<?=$this->lang->button->cancel?>",className: "btn-sm pull-left",}},
            callback: function(result)
            {
              if(result) {
                 $.ajax({
                  url : "<?=$this->baseurl->backend->process?>",
                  type: "POST",
                  data : {module:'News',action:'select-gallery-del',items_list:numbers,news_id:id},
                  success: function(data, textStatus, jqXHR)
                  {
                    if(textStatus=='success'){$( "#smessage" ).html(data);}
                    $("#sloading").html('<i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>');
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    alert('Error!');
                    window.location.reload();
                  }
                });//ajax
              }else{
                $('th input[class="select_del"], td input[class="select_del"]').prop('checked', false);
              }//result
              $("#sloading").html('<i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>');
            }//callback
            }	);//bootbox.confirm
      } else {
      alert("<?=$this->lang->alert->notify->none_select?>");
      }
    });//#select_items
    $("#select_files_items").on('click', function() {
      var strChoices = "";
      var objCBarray = document.getElementsByName('files_items');
      var id = $("#files_news_id").val()
      var numbers = new Array();
      for (i = 0; i < objCBarray.length; i++) {
      if (objCBarray[i].checked) {
        numbers[i]=objCBarray[i].value;
        strChoices += "" + objCBarray[i].value + "<br />";
      }
      }
      if (strChoices.length > 0) {
        $("#zloading").html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
        bootbox.confirm({
            message: "<?=$this->lang->alert->confirm->delete_all?><br />"+strChoices,
            buttons: {
              confirm: { label: "<?=$this->lang->button->confirm?>",className: "btn-primary btn-sm",},
              cancel: {	 label: "<?=$this->lang->button->cancel?>",className: "btn-sm pull-left",}},
            callback: function(result)
            {
              if(result) {
                 $.ajax({
                  url : "<?=$this->baseurl->backend->process?>",
                  type: "POST",
                  data : {module:'News',action:'select-files-del',items_list:numbers,news_id:id},
                  success: function(data, textStatus, jqXHR)
                  {
                    if(textStatus=='success'){$( "#zmessage" ).html(data);}
                    $("#zloading").html('<i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>');
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    alert('Error!');
                    window.location.reload();
                  }
                });//ajax
              }else{
                $('th input[class="select_files_del"], td input[class="select_files_del"]').prop('checked', false);
              }//result
              $("#zloading").html('<i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>');
            }//callback
            }	);//bootbox.confirm
      } else {
      alert("<?=$this->lang->alert->notify->none_select?>");
      }
    });//#select_files_items
  });
  $.switcher();
	// 	<!-- Editor -->
	CKEDITOR.replace( 'news_description' );
	CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
	CKEDITOR.config.allowedContent = true;
	CKEDITOR.config.autoParagraph = false;
  // 	<!-- Editor -->
  $('.select2').css('width','100%').select2({allowClear:true});

  $(function () {
	  $('#frm').parsley().on('field:validated', function() {
		var ok = $('.parsley-error').length === 0;
			$('.bs-callout-info').toggleClass('hidden', !ok);
			$('.bs-callout-warning').toggleClass('hidden', ok);
		 })
	  .on('form:submit', function() {
       <?php  if($this->checkUID('level')==9){?>
        var sticky;
        var status;
        if($("#news_sticky").is(':checked')){  sticky=1;  }else{  sticky=0; }
        if($("#news_status").is(':checked')){  status=1;  }else{  status=0; }
        <?php }?>
			  var formData = new FormData();
				formData.append('module', 'News');
				formData.append('action', 'update-news');
        formData.append('id',$("#news_id").val());
        formData.append('category',$("#news_category").val());
        formData.append('department',$("#news_department").val());
        formData.append('del_images',$("input[name=del_images]:checked").val());
				formData.append('title',$("#news_title").val());
        formData.append('overview',$("#news_overview").val());
				formData.append('description',CKEDITOR.instances.news_description.getData());
        formData.append('youtube',$("#news_youtube").val());
        <?php  if($this->checkUID('level')==9){?>
        formData.append('sticky',sticky);
        formData.append('status',status);
        <?php }?>
        formData.append('news_start',$("#news_start").val());
        formData.append('news_end',$("#news_end").val());

			  $( "#loading").html('<i class="ace-icon fa fa-spinner fa-spin white bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
				$.ajax({
					url : "<?=$this->baseurl->backend->process?>",
					type: "POST",
					contentType: false,
					processData: false,
					data : formData,
					success: function(data, textStatus, jqXHR)
					{
						if(textStatus=='success'){$( "#message" ).html(data);}
						$( "#loading").html('<i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>');
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error!');
						location.reload();
					}
				});
		  return false;
	  });//update-news
    $('#sfrm').parsley().on('field:validated', function() {
		var ok = $('.parsley-error').length === 0;
			$('.bs-callout-info').toggleClass('hidden', !ok);
			$('.bs-callout-warning').toggleClass('hidden', ok);
		 })
	  .on('form:submit', function() {
			  var formData = new FormData();
        var title = $('input:text.get_title').serialize();
				formData.append('module', 'News');
				formData.append('action', 'update-gallery-title');
        formData.append('news_id',$("#images_news_id").val());
        formData.append('items_title',title);
			  $( "#sloading").html('<i class="ace-icon fa fa-spinner fa-spin white bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
				$.ajax({
					url : "<?=$this->baseurl->backend->process?>",
					type: "POST",
					contentType: false,
					processData: false,
					data : formData,
					success: function(data, textStatus, jqXHR)
					{
						if(textStatus=='success'){$( "#smessage" ).html(data);}
						$( "#sloading").html('<i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>');
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error!');
						location.reload();
					}
				});
		  return false;
	  });//update-gallery-title
    $('#zfrm').parsley().on('field:validated', function() {
		var ok = $('.parsley-error').length === 0;
			$('.bs-callout-info').toggleClass('hidden', !ok);
			$('.bs-callout-warning').toggleClass('hidden', ok);
		 })
	  .on('form:submit', function() {
			  var formData = new FormData();
        var title = $('input:text.get_files_title').serialize();
				formData.append('module', 'News');
				formData.append('action', 'update-files-title');
        formData.append('news_id',$("#files_news_id").val());
        formData.append('items_title',title);
			  $( "#zloading").html('<i class="ace-icon fa fa-spinner fa-spin white bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
				$.ajax({
					url : "<?=$this->baseurl->backend->process?>",
					type: "POST",
					contentType: false,
					processData: false,
					data : formData,
					success: function(data, textStatus, jqXHR)
					{
						if(textStatus=='success'){$( "#zmessage" ).html(data);}
						$( "#zloading").html('<i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>');
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error!');
						location.reload();
					}
				});
		  return false;
	  });//update-gallery-title
    $('#modal-open-images').on("click", ".confirm-images-delete", function() {
      var id= $("#images_id").val();
      $( "#delete_loading").html('<i class="ace-icon fa fa-spinner fa-spin bigger-130"></i>');
      bootbox.confirm({
        message: "<?=$this->lang->alert->confirm->images_delete?> "+id+" ?",
        buttons: {
          confirm: { label: "<?=$this->lang->button->confirm?>",className: "btn-primary btn-sm",},
          cancel: { label: "<?=$this->lang->button->cancel?>",className: "btn-sm pull-left",}},
        callback: function(result) {
          if(result) {
             $.ajax({
              url : "<?=$this->baseurl->backend->process?>",
              type: "POST",
              data : {module:'News',action:'single-images-delete',images_id:id,refresh:0},
              success: function(data, textStatus, jqXHR)
              {
                if(textStatus=='success'){$( "#xmessage" ).html(data);}
                $("#delete_loading").html('<i class="ace-icon fa fa-trash"></i> <?=$this->lang->button->delete?>');
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert('Error!');
                window.location.reload();
              }
            });//ajax
          }//result
          $("#delete_loading").html('<i class="ace-icon fa fa-trash"></i> <?=$this->lang->button->delete?>');
        }//callback
        }	);//.confirm-images-delete
    });//.confirm-images-delete
	});
</script>
<?php
 }else{
   $this->xFunction->pageReload($this->lang->alert->notify->error,$this->baseurl->dashboard);
 } //Check News
?>
