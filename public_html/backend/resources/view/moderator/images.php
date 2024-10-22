<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
        <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
				<li><a href="javascript:void(0)"><?=$this->lang->menu->news?></a></li>
        <li class="active"><?=$this->lang->module->news->images?></li>
      </ul>
		</div>

		<div class="page-content">
			<div class="col-xs-12">
				<div class="page-header">
					<h1><?=$this->lang->module->news->images?>
					  <div class="btn-group pull-right">
						  <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" aria-expanded="false" id="sloading">
								 <?=$this->lang->action->menu?> <i class="ace-icon fa fa-angle-down icon-on-right"></i>
						  </button>
						  <ul class="dropdown-menu">
							  <li><a href="#modal-upload" data-toggle="modal" data-backdrop="static" data-keyboard="false"><?=$this->lang->action->add?></a></li>
							  <li><a href="javascript:void(0)" id="select_items"><?=$this->lang->action->delete_selected?></a></li>
							  <li><a href="<?=$this->baseurl->backend->module->news->images?>" id="reset_filter_table"><?=$this->lang->action->reset_filter?></a></li>
						  </ul>
					  </div>// 	<!-- /.btn-group left-->
					</h1>
        </div>// 	<!-- /.page-header -->
       <!--AJAX Message-->
        <div id="dmessage"></div>
        <!--AJAX Message-->
				<table id="dynamic-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
							<th width="5%" class="center no-sort"> <label class="pos-rel"><input type="checkbox" class="ace" id="check-all" /><span class="lbl"></span> </label></th>
              <th width="5%" class="center"><?=$this->lang->label->id?></th>
              <th width="10%" class="center"><?=$this->lang->label->images?></th>
							<th width="30%"><?=$this->lang->label->title?></th>
							<th width="30%"><?=$this->lang->label->link_url?></th>
							<th width="10%" class="no-sort"><?=$this->lang->label->performer?></th>
							<th width="10%" class="center no-sort"></th>
            </tr>
          </thead>
          <tbody>
						<?php
							if(is_array($imagesList)){
								foreach($imagesList as $value){
									$img_src=$this->mediaURL("news").$value["img_src"];
									$checkbox='';
									if($this->checkUID('level')==9){
										$checkbox=1;
									}else{
										if($this->checkUID('id')==$value['account_id']){
											$checkbox=1;
										}
									}
						?>
              <tr>
								<td class="center">
									<?php
											if(!empty($checkbox)){
									?>
									<label class="pos-rel"><input id="id_<?=$value['id']?>" name="items" value="<?=$value['id']?>" type="checkbox" class="ace" /><span class="lbl"></span></label>
									<?php
											}
									?>
								</td>
								<td class="center"><?=$value['id']?></td>
                <td class="center">
									<?php if(!empty($value['img_src'])){ ?>
										<a href="<?=$img_src?>" data-lity>
										 <img src="<?=$img_src?>"  width="80"  class="bordor" />
										</a>
									<?php }?>
                </td>
							  <td><?=$this->xFunction->htmlspec($value['title'])?></td>
								<td>
                  <div class="input-group w100per"><input type="text" id="link_url_<?=$value['id']?>" name="link_url_<?=$value['id']?>" class="form-control" value="<?=$img_src?>" onfocus="this.select()"><span class="copy input-group-addon in_span" id="w50px" data-clipboard-action="copy" data-clipboard-target="input#link_url_<?=$value['id']?>"><i class="fa fa-copy bigger-110"></i> <?=$this->lang->action->btn_copy?></span></div>
								</td>
								<td><?=$this->xFunction->icoLEVEL($value['userlevel'])?> <?=$value['username']?></td>
							  <td class="center">
									<a href="#modal-open-images" data-toggle="modal" onclick="load_form_images('<?=$value['id']?>')" class="btn btn-primary btn-xs btn-action" title="<?=$this->lang->title->edit?>">
										<i class="ace-icon fa fa-pencil-square-o" aria-hidden="true"></i>
									</a>
								</td>
              </tr>
						<?php
							 }
							}
						?>
          </tbody>
        </table>
      </div>// 	<!-- /.col-xs-12 -->
		</div>// 	<!-- /.page-content -->
	</div>
</div>// 	<!-- /.main-content -->
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
                	 <input type="file" name="news_images[]" id="images" multiple >
                     <span class="ace-file-container" data-title="<?=$this->lang->label->select?>">
                         <span class="ace-file-name" data-title="...">
                             <i class=" ace-icon fa fa-upload"></i>
                         </span>
                     </span>
                 </label>
                 <?=$this->xFunction->placeholder('images_extensions','span')?><br />
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
       	   <input type="hidden" name="news_images_submit" value="1"/>
           <input type="hidden" id="module" name="module" value="News"/>
           <input type="hidden" id="action" name="action" value="upload-news-images"/>
					 <input type="hidden" name="refresh" value="1"/>
         	 <button class="btn btn-sm pull-left" data-dismiss="modal" id="close-modal"><i class="ace-icon fa fa-times"></i> <?=$this->lang->button->close?></button>
           <div class="clearfix"></div>
        </div>
      </form>
    </div><!--modal-content-->
  </div> <!--modal-dialog-->
</div><!--modal-wizard-->
<!--Upload Img FORM-->
<!--modal-open-images-->
<div id="modal-open-images" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="images_frm" name="images_frm" class="form-horizontal" role="form" method="post" onsubmit="return edit_images_title()">
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
// 	<!-- page specific plugin scripts -->
<link rel="stylesheet"  href="<?=$this->plugins?>lity/dist/lity.css" />
<script src="<?=$this->plugins?>lity/dist/lity.js" ></script>
<script src="<?=$this->_assets?>js/jquery.dataTables.min.js"></script>
<script src="<?=$this->_assets?>js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?=$this->_assets?>js/dataTables.responsive.js"></script>
<link rel="stylesheet"  href="<?=$this->_assets?>css/dataTables.responsive.css" />
<script src="<?=$this->_assets?>js/dataTables.buttons.min.js"></script>
<script src="<?=$this->_assets?>js/dataTables.select.min.js"></script>
<script src="<?=$this->_assets?>js/bootbox.js"></script>
<script src="<?=$this->plugins?>upload_multiple/js/jquery.form.js"></script>
// 	<!-- dataTables plugin -->
<script type="text/javascript">
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
		 /*Function edit_images_title*/
	   function edit_images_title(){
	     var id= $("#images_id").val();
	     var name= $("#images_name").val();
	     $("#load_images_title").html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
	     $.ajax({
	      url : "<?=$this->baseurl->backend->process?>",
	      type: "POST",
	      data : {module:'News',action:'edit-images-title',images_id:id,images_name:name,refresh:1},
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
	   }
	   /*Function edit_images_title*/
		 /*Function load_news_images*/
	   $(document).ready(function () {
	     /* Upload Images & Files */
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
	     /* Upload Images & Files */
	   });//document ready
		jQuery(function($) {
				var myTable = $('#dynamic-table').DataTable( {bAutoWidth: false,responsive: true,'columnDefs': [{'targets': 0,'targets': 'no-sort','searchable':false,'orderable':false,}],
			  "stateSave": true,
			  "language": {"zeroRecords": "<?=$this->lang->dataTables->zeroRecords?>",
			  "lengthMenu": "<?=$this->lang->dataTables->lengthMenu?>",
			  "info": "<?=$this->lang->dataTables->info?>",
			  "sInfoEmpty": "<?=$this->lang->dataTables->sInfoEmpty?>",
			  "sInfoFiltered": "<?=$this->lang->dataTables->sInfoFiltered?>",
			  "emptyTable" 	:  "<?=$this->lang->dataTables->emptyTable?>",
			  "search": "<?=$this->lang->dataTables->search?>",
			  "paginate": {"first": "<?=$this->lang->dataTables->paginate_first?>",
			  "next": "<?=$this->lang->dataTables->paginate_next?>",
			  "previous": "<?=$this->lang->dataTables->paginate_previous?>",
			  "last": "<?=$this->lang->dataTables->paginate_last?>",
			  },
			  "select": {"rows": {"_": " <?=$this->lang->dataTables->select_more?>","0": "",}}},'order': [1, 'desc'],select: {style: 'multi',}} );
				$('#reset_filter_table').on('click', function(){
						if(confirm("<?=$this->lang->dataTables->confirm_reset?>")){
							myTable.state.clear();
							alert('<?=$this->lang->dataTables->reset_ok?>');
							return true;
						}else{
							return false;
						}
				 });
				  myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				$("#select_items").on('click', function() {
				  var strChoices = "";
				  var objCBarray = document.getElementsByName('items');
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
										data : {module:'News',action:'select-images-del',items_list:numbers},
										success: function(data, textStatus, jqXHR)
										{
											if(textStatus=='success'){$( "#dmessage" ).html(data);}
											$("#sloading").html('<?=$this->lang->action->menu?> <i class="ace-icon fa fa-angle-down icon-on-right"></i>');
										},
										error: function (jqXHR, textStatus, errorThrown)
										{
											alert('Error!');
											window.location.reload();
										}
									});//ajax
								}else{
									$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
									$('#dynamic-table tr').removeClass("selected");
								}//result
								$("#sloading").html('<?=$this->lang->action->menu?> <i class="ace-icon fa fa-angle-down icon-on-right"></i>');
							}//callback
						});//bootbox.confirm
				}else{
					 alert("<?=$this->lang->alert->notify->none_select?>");
				}
			});//#select_items
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
	              data : {module:'News',action:'single-images-delete',images_id:id,refresh:1},
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
