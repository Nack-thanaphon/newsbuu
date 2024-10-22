<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
        <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
				<li><a href="javascript:void(0)"><?=$this->lang->menu->slide?></a></li>
        <li class="active"><?=$this->lang->module->slide->list?></li>
      </ul>
		</div>

		<div class="page-content">
			<div class="col-xs-12">
				<div class="page-header">
					<h1><?=$this->lang->module->slide->list?>
					  <div class="btn-group pull-right">
              <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" aria-expanded="false" id="sloading">
                   <?=$this->lang->action->menu?> <i class="ace-icon fa fa-angle-down icon-on-right"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a href="<?=$this->baseurl->backend->module->slide->add?>" data-toggle="modal" data-backdrop="static" data-keyboard="false"><?=$this->lang->action->add?></a></li>
                <li><a href="javascript:void(0)" id="select_items" ><?=$this->lang->action->delete_selected?></a></li>
                <li><a href="<?=$this->baseurl->backend->module->slide->list?>" id="reset_filter_table"><?=$this->lang->action->reset_filter?></a></li>
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
              <th width="10%" class="center"><?=$this->lang->label->id?></th>
              <th width="15%" class="center"><?=$this->lang->label->images?></th>
							<th width="40%"><?=$this->lang->label->title?></th>
							<th width="10%" class="center"><?=$this->lang->label->sort_order?></th>
							<th width="10%" class="center no-sort"><?=$this->lang->label->status?></th>
							<th width="10%" class="center no-sort"></th>
            </tr>
          </thead>
          <tbody>
						<?php
							if(is_array($slideList)){
								foreach($slideList as $value){
						?>
                <tr>
								  <td class="center"><label class="pos-rel"><input id="id_<?=$value['id']?>" name="items" value="<?=$value['id']?>" type="checkbox" class="ace" /><span class="lbl"></span></label></td>
                  <td class="center"><?=$value['id']?></td>
                  <td class="center">
                   <?php if(!empty($value['img_thumb'])){ ?>
										 <a href="<?=$this->mediaURL('banner').$value['img_thumb']?>" data-lity>
										  <img src="<?=$this->mediaURL('banner').$value['img_thumb']?>"  width="150"  class="bordor" />
									   </a>
									 <?php }?>
								  </td>
								  <td><?=$this->xFunction->htmlspec($value['title'])?></td>
                  <td class="center">
										<span><?=$value['sort_order']?></span>
										<a class="green open-model-edit-rank" href="#modal-edit-rank" data-id="<?=$value['id']?>" data-rank="<?=$value['sort_order']?>" data-toggle="modal" data-backdrop="static" data-keyboard="false" title="<?=$this->lang->title->edit_ranking?>">
											<i class="ace-icon fa fa-sort-numeric-desc bigger-130" aria-hidden="true"></i>
										</a>
									</td>
								  <td class="center"><?=$this->xFunction->checkSTATUS($value['status'])?><br />
										<a class="change-status-confirm" id="sloading_<?=$value['id']?>" data-id="<?=$value['id']?>" href="javascript:void(0)"  title="<?=$this->lang->title->change_status?>">
											<i class="ace-icon fa fa-retweet bigger-130" aria-hidden="true"></i>
										</a>
									</td>
								  <td class="center">
										<a href="<?=$this->baseurl->backend->module->slide->view.$value['id']?>" class="btn btn-info btn-xs btn-action" title="<?=$this->lang->title->detail?>">
											<i class="ace-icon fa fa-file-text-o" aria-hidden="true"></i>
										</a>
										<a href="<?=$this->baseurl->backend->module->slide->edit.$value['id']?>" class="btn btn-primary btn-xs btn-action" title="<?=$this->lang->title->edit?>">
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

<script src="<?=$this->plugins?>check/parsley_th.js" ></script>
<link rel="stylesheet"  href="<?=$this->plugins?>check/parsley.css" />

<!--Edit Rank Form-->
<div id="modal-edit-rank" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="efrm" name="efrm" class="form-horizontal" role="form" method="post" action=""  data-parsley-validate="">
        <div id="modal-wizard-container">
          <div class="modal-header"><h3 ><?=$this->lang->page->edit_ranking?></h3></div>
          <div class="modal-body step-content">

            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" ><?=$this->lang->label->id?></label>
              <div class="col-sm-9"><input  type="text" id="eid" name="eid" class="col-xs-10 col-sm-8"  readonly="readonly" /></div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" ><?=$this->lang->label->ranking?></label>
              <div class="col-sm-9"><input  type="number" id="eranking" name="eranking" class="col-xs-10 col-sm-8" required="" /></div>
            </div><!--form-group-->

          </div><!--modal-body step-content-->
        </div><!--modal-wizard-container-->

        <div class="modal-footer wizard-actions">
          <!--AJAX Message-->
          <div id="emessage"></div>
          <!--AJAX Message-->
          <button class="btn btn-success btn-sm btn-next" data-last="Finish" id="eloading">
          <i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>
          </button>
          <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal" id="eclose-modal">
          <i class="ace-icon fa fa-times"></i> <?=$this->lang->button->close?>
          </button>
        </div><!--modal-footer wizard-actions-->
      </form>
    </div><!--modal-content-->
  </div>  <!--modal-dialog-->
</div><!--modal-wizard-->
<!--Edit Rank Form-->

// 	<!-- Jquery Code -->
<script type="text/javascript">
	$(document).on("click", ".open-model-edit-rank", function () {
		 var id = $(this).data('id');
		 var ranking = $(this).data('rank');
		 if(id!=''){
			 $("#eid").val(id);
			 $("#eranking").val(ranking);
		 }
	 });

	$('#modal-edit-rank').on('shown.bs.modal', function () {
    $('#eranking').focus();
		$('#eranking').select();
  });

	$('#eclose-modal').click(function() {
    $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
		$('#dynamic-table tr').removeClass("selected");
  });

	$(function () {
	  $('#efrm').parsley().on('field:validated', function() {
      var ok = $('.parsley-error').length === 0;
          $('.bs-callout-info').toggleClass('hidden', !ok);
          $('.bs-callout-warning').toggleClass('hidden', ok);
       })
      .on('form:submit', function() {
	        var id = $("#eid").val();
          var ranking = $("#eranking").val();
          $( "#eloading").html('<i class="ace-icon fa fa-spinner fa-spin white bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
          $.ajax({
              url : "<?=$this->baseurl->backend->process?>",
              type: "POST",
              data : {module:'Slide',action:'edit-ranking',banner_id:id,ranking:ranking},
              success: function(data, textStatus, jqXHR)
              {
                  if(textStatus=='success'){  $( "#emessage" ).html(data); }
                  $( "#eloading" ).html('<i class="fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>');
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
								alert('Error!');
								window.location.reload();
              }
          });
          return false;
    });
  });
</script>
// 	<!-- Jquery Code -->

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
// 	<!-- dataTables plugin -->
<script type="text/javascript">
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
			  "select": {"rows": {"_": " <?=$this->lang->dataTables->select_more?>","0": "",}}},'order': [4, 'desc'],select: {style: 'multi',}} );
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
				$('#dynamic-table').on("click", ".change-status-confirm", function() {
					var id = $(this).data('id');
					$( "#sloading_"+id).html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i>');
					bootbox.confirm({
						message: "<?=$this->lang->alert->confirm->change_status?>: "+id+" ?",
						buttons: {
						  confirm: { label: "<?=$this->lang->button->confirm?>",className: "btn-primary btn-sm",},
						  cancel: { label: "<?=$this->lang->button->cancel?>",className: "btn-sm pull-left",}},
						callback: function(result) {
							if(result) {
								 $.ajax({
									url : "<?=$this->baseurl->backend->process?>",
									type: "POST",
									data : {module:'Slide',action:'change-status',banner_id:id},
									success: function(data, textStatus, jqXHR)
									{
										if(textStatus=='success'){$( "#dmessage" ).html(data);}
										$("#sloading_"+id).html('<i class="ace-icon fa fa-retweet bigger-130" aria-hidden="true"></i>');
									},
									error: function (jqXHR, textStatus, errorThrown)
									{
										alert('Error!');
										window.location.reload();
									}
								});//ajax
							}//result
							$( "#sloading_"+id).html('<i class="ace-icon fa fa-retweet bigger-130" aria-hidden="true"></i>');
						}//callback
					  }	);//.change-status-confirm
				});//.change-status-confirm
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
											data : {module:'Slide',action:'select-del',items_list:numbers},
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
							  }	);//bootbox.confirm
				  } else {
					alert("<?=$this->lang->alert->notify->none_select?>");
				  }
			});//#select_items
		});
</script>
