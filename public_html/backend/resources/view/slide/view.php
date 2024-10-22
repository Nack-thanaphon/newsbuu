<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
          <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
  				<li><a href="javascript:void(0)"><?=$this->lang->menu->slide?></a></li>
          <li><a href="<?=$this->baseurl->backend->module->slide->list?>"><?=$this->lang->module->slide->list?></a></li>
          <li class="active"><?=$this->lang->page->slide_view?></li>
        </ul>
    </div><!-- /.breadcrumbs -->
    <div class="page-content">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="page-header">
         <h1><?=$this->lang->page->slide_view?></h1>
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
                    <div class="profile-info-name"><?=$this->lang->label->banner_img?> </div>
                    <div class="profile-info-value">
                      <span>
                        <?php if(!empty($getData['img_thumb'])){ ?>
                          <a href="<?=$this->mediaURL('banner').$getData['img_thumb']?>" data-lity>
                            <img src="<?=$this->mediaURL('banner').$getData['img_thumb']?>"  width="200"  class="bordor" />
                          </a>
                        <?php }?>
                      </span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->banner_mb_img?> </div>
                    <div class="profile-info-value">
                      <span>
                        <?php if(!empty($getData['mb_img_thumb'])){ ?>
                          <a href="<?=$this->mediaURL('banner').$getData['mb_img_thumb']?>" data-lity>
                            <img src="<?=$this->mediaURL('banner').$getData['mb_img_thumb']?>"  width="200"  class="bordor" />
                          </a>
                        <?php }?>
                      </span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->title?> </div>
                    <div class="profile-info-value">
                      <span>
                        <?=$this->xFunction->htmlspec($getData['title'])?>
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
                    <div class="profile-info-name"><?=$this->lang->label->link_url?> </div>
                    <div class="profile-info-value">
                      <span>
                        <a href="<?=urldecode($getData['link_url'])?>" target="_blank"><?=urldecode($getData['link_url'])?></a>
                      </span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"><?=$this->lang->label->ranking?> </div>
                    <div class="profile-info-value">
                      <span>
                        <?=$getData['sort_order']?>
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
              </div><!--profile-user-info profile-user-info-striped-->
            </div><!--row-->
            <div class="clearfix form-actions">
              <a href="<?=$this->baseurl->backend->module->slide->list?>" class="btn pull-left" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <?=$this->lang->button->back?></a>
              <a href="<?=$this->baseurl->backend->module->slide->edit.$getData['id']?>" class="btn btn-info pull-right" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?=$this->lang->button->edit?></a>
              <div class="clearfix"></div>
            </div>
          </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
      </div><!-- /.col-sm-10 col-sm-offset-1 -->
    </div><!-- /.page-content -->
  </div><!-- /.main-content-inner -->
</div><!-- /.main-content -->
<link rel="stylesheet"  href="<?=$this->plugins?>lity/dist/lity.css" />
<script src="<?=$this->plugins?>lity/dist/lity.js" ></script>
