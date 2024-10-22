<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
          <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
          <li><a href="javascript:void(0)"><?=$this->lang->menu->moderator->main?></a></li>
          <li class="active"><?=$this->lang->menu->moderator->setting?></li>
        </ul>
    </div>// 	<!-- /.breadcrumbs -->
    // 	<!-- /plugins -->
    <script src="<?=$this->plugins?>check/parsley_th.js" ></script>
    <link rel="stylesheet"  href="<?=$this->plugins?>check/parsley.css" />
    <script src="<?=$this->plugins?>check/form.js" ></script>
    <script src="<?=$this->plugins?>content/autocomplete_off.js" ></script>
    // 	<!-- /plugins -->
    <div class="page-content">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="page-header">
         <h1><?=$this->lang->menu->moderator->setting?></h1>
        </div>// 	<!-- /.page-header -->
        <div class="row">
          <div class="col-xs-12">
          	<form id="frm" name="frm" class="form-horizontal" role="form" method="post" action=""  data-parsley-validate=""  enctype="multipart/form-data">
              <div class="row">
                <div class="profile-user-info profile-user-info-striped">
                  <div class="profile-info-row">
                      <div class="profile-info-name"><?=$this->lang->label->breadcrumbs?> </div>
                      <div class="profile-info-value">
                        <span>
                          <?php if(!empty($getData['breadcrumbs'])){ ?>
                            <a href="<?=$this->mediaURL('breadcrumbs').$getData['breadcrumbs']?>" data-lity>
                              <img src="<?=$this->mediaURL('breadcrumbs').$getData['breadcrumbs']?>"  width="200"  class="bordor" />
                            </a>
                          <?php }?>
                          <div id="myImg"></div>
                          <label class="ace-file-input">
                          	  <input type="file" name="images1" id="images1" multiple="" autocomplete="off" required="">
                              <span class="ace-file-container" data-title="<?=$this->lang->label->select?>">
                                <span class="ace-file-name" data-title="...">
                                  <i class="ace-icon fa fa-upload"></i>
                                </span>
                              </span>
                          </label>
                          <?=$this->xFunction->placeholder('breadcrumbs','div')?>
                        </span>
                      </div>
                  </div>
              </div><!--row-->
              <!--AJAX Message-->
              <div id="message"></div>
              <!--AJAX Message-->
              <div class="clearfix form-actions margin12">                
                <button class="btn btn-info pull-right"  type="submit" id="loading"><i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?></button>
                <div class="clearfix"></div>
              </div>
            </form><!--form-->
          </div>// 	<!-- /.col-xs-12 -->
        </div>// 	<!-- /.row -->
      </div>// 	<!-- /.col-sm-10 col-sm-offset-1 -->
    </div>// 	<!-- /.page-content -->
  </div>// 	<!-- /.main-content-inner -->
</div>// 	<!-- /.main-content -->
<link rel="stylesheet"  href="<?=$this->plugins?>lity/dist/lity.css" />
<script src="<?=$this->plugins?>lity/dist/lity.js" ></script>
<script type="text/javascript">
  // 	<!-- media Ex-->
	$(function () {
		$("#images1").change(function () {if (this.files && this.files[0]) {var reader = new FileReader();reader.onload = imageIsLoaded;reader.readAsDataURL(this.files[0]);}});
	});
	function imageIsLoaded(e) {	$('#myImg').html(' <img src="'+e.target.result+'"  width="200"  class="bordor" />');};
  // 	<!-- media Ex-->
  $(function () {
	  $('#frm').parsley().on('field:validated', function() {
		var ok = $('.parsley-error').length === 0;
			$('.bs-callout-info').toggleClass('hidden', !ok);
			$('.bs-callout-warning').toggleClass('hidden', ok);
		 })
	  .on('form:submit', function() {
			  var formData = new FormData();
				formData.append('module', 'Moderator');
				formData.append('action', 'setting');
				formData.append('breadcrumbs', $('input[name=images1]')[0].files[0]);
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
	  });
	});
</script>
