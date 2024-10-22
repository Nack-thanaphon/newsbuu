<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
          <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
  				<li><a href="javascript:void(0)"><?=$this->lang->menu->slide?></a></li>
          <li><a href="<?=$this->baseurl->backend->module->slide->list?>"><?=$this->lang->module->slide->list?></a></li>
          <li class="active"><?=$this->lang->page->slide_add?></li>
        </ul>
    </div><!-- /.breadcrumbs -->
    <!-- /plugins -->
    <script src="<?=$this->plugins?>check/parsley_th.js" ></script>
    <link rel="stylesheet"  href="<?=$this->plugins?>check/parsley.css" />
    <script src="<?=$this->plugins?>check/form.js" ></script>
    <script src="<?=$this->plugins?>content/autocomplete_off.js" ></script>
    <!-- /plugins -->
    <div class="page-content">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="page-header">
         <h1><?=$this->lang->page->slide_add?></h1>
        </div><!-- /.page-header -->
        <div class="row">
          <div class="col-xs-12">
          	<form id="frm" name="frm" class="form-horizontal" role="form" method="post" action=""  data-parsley-validate=""  enctype="multipart/form-data">
              <div class="row">
                <div class="profile-user-info profile-user-info-striped">
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->banner_img?> </div>
                      <div class="profile-info-value">
                        <span>
                          <div id="myImg"></div>
                          <label class="ace-file-input">
                          	  <input type="file" name="images1" id="images1" multiple="" autocomplete="off" required="">
                              <span class="ace-file-container" data-title="<?=$this->lang->label->select?>">
                                <span class="ace-file-name" data-title="...">
                                  <i class="ace-icon fa fa-upload"></i>
                                </span>
                              </span>
                          </label>
                          <?=$this->xFunction->placeholder('slide_banner','div')?>
                        </span>
                      </div>
                  </div>
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->banner_mb_img?> </div>
                      <div class="profile-info-value">
                        <span>
                          <div id="myImg2"></div>
                          <label class="ace-file-input">
                          	  <input type="file" name="images2" id="images2" multiple="" autocomplete="off"  required="">
                              <span class="ace-file-container" data-title="<?=$this->lang->label->select?>">
                                <span class="ace-file-name" data-title="...">
                                  <i class="ace-icon fa fa-upload"></i>
                                </span>
                              </span>
                          </label>
                          <?=$this->xFunction->placeholder('slide_mbbanner','div')?>
                        </span>
                      </div>
                  </div>
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->title?> </div>
                      <div class="profile-info-value">
                        <span>
                          <input  type="text" id="title" name="title"  class="form-control" required="" />
                        </span>
                      </div>
                  </div>
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->description?> </div>
                      <div class="profile-info-value">
                        <span>
                          <textarea id="description" name="description" cols="50" class="form-control" rows="4" ></textarea>
                        </span>
                      </div>
                  </div>
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->link_url?> </div>
                      <div class="profile-info-value">
                        <span>
                          <input  type="text" id="link_url" name="link_url"  class="form-control" <?=$this->xFunction->placeholder('link_url')?> />
                        </span>
                      </div>
                  </div>
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->ranking?> </div>
                      <div class="profile-info-value">
                        <span>
                          <input  type="number" id="sort_order" name="sort_order" onclick="this.select()" />
                          <?=$this->xFunction->placeholder('sort_desc','span')?>
                        </span>
                      </div>
                  </div>
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->status?> </div>
                      <div class="profile-info-value">
                        <span>
                          <input type="checkbox" id="status" name="status" class="switcher" value="1">
                        </span>
                      </div>
                  </div>
                </div><!--profile-user-info profile-user-info-striped-->
              </div><!--row-->
              <!--AJAX Message-->
              <div id="message"></div>
              <!--AJAX Message-->
              <div class="clearfix form-actions">
                <a href="<?=$this->baseurl->backend->module->slide->list?>" class="btn pull-left" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <?=$this->lang->button->back?></a>
                <button class="btn btn-info pull-right"  type="submit" id="loading"><i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?></button>
                <div class="clearfix"></div>
              </div>
            </form><!--form-->
          </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
      </div><!-- /.col-sm-10 col-sm-offset-1 -->
    </div><!-- /.page-content -->
  </div><!-- /.main-content-inner -->
</div><!-- /.main-content -->
<script src="<?=$this->plugins?>ckeditor/ckeditor.js" ></script>
<script src="<?=$this->plugins?>ckeditor/config.js" ></script>
<link href="<?=$this->plugins?>switcher/css/switcher.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->plugins?>switcher/js/jquery.switcher.js"></script>
<script type="text/javascript">
  $.switcher();
  <!-- media Ex-->
	$(function () {
		$("#images1").change(function () {if (this.files && this.files[0]) {var reader = new FileReader();reader.onload = imageIsLoaded;reader.readAsDataURL(this.files[0]);}});
    $("#images2").change(function () {if (this.files && this.files[0]) {var reader = new FileReader();reader.onload = imageIsLoaded2;reader.readAsDataURL(this.files[0]);}});
	});
	function imageIsLoaded(e) {	$('#myImg').html(' <img src="'+e.target.result+'"  width="200"  class="bordor" />');};
  function imageIsLoaded2(e) {$('#myImg2').html(' <img src="'+e.target.result+'"  width="200"  class="bordor" />');};
  <!-- media Ex-->

	<!-- Editor-->
	CKEDITOR.replace( 'description' );
	CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
	CKEDITOR.config.allowedContent = true;
	CKEDITOR.config.autoParagraph = false;
  <!-- CKEDITOR-->

  $(function () {
	  $('#frm').parsley().on('field:validated', function() {
		var ok = $('.parsley-error').length === 0;
			$('.bs-callout-info').toggleClass('hidden', !ok);
			$('.bs-callout-warning').toggleClass('hidden', ok);
		 })
	  .on('form:submit', function() {
		  var description=CKEDITOR.instances.description.getData();
		  if(description==''){
			  alert('<?=$this->lang->alert->required->description?>');
			  CKEDITOR.instances.description.focus();
		  }else{
        var status;
        if($("#status").is(':checked')){status=1;}else{status=0;}
			  var formData = new FormData();
				formData.append('module', 'Slide');
				formData.append('action', 'save-data');
				formData.append('images1', $('input[name=images1]')[0].files[0]);
        formData.append('images2', $('input[name=images2]')[0].files[0]);
				formData.append('title',$("#title").val());
				formData.append('description',CKEDITOR.instances.description.getData());
        formData.append('link_url',$("#link_url").val());
        formData.append('sort_order',$("#sort_order").val());
        formData.append('status',status);
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
		  }
		  return false;
	  });
	});
</script>
