<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
        <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->backend->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
				<li><a href="javascript:void(0)"><?=$this->lang->menu->moderator->main?></a></li>
        <li class="active"><?=$this->lang->menu->moderator->newstype?></li>
      </ul>
		</div>

		<div class="page-content">
			<div class="col-xs-12">
				<div class="page-header">
					<h1><?=$this->lang->menu->moderator->newstype?>
					  <div class="btn-group pull-right">
						  <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" aria-expanded="false" id="sloading">
								 <?=$this->lang->action->menu?> <i class="ace-icon fa fa-angle-down icon-on-right"></i>
						  </button>
						  <ul class="dropdown-menu">
								<li><a href="#modal-add" data-toggle="modal" data-backdrop="static" data-keyboard="false"><?=$this->lang->action->add?></a></li>
							  <li><a href="javascript:void(0)" id="select_items"><?=$this->lang->action->delete_selected?></a></li>
							  <li><a href="<?=$this->baseurl->backend->module->moderator->newstype?>" id="reset_filter_table"><?=$this->lang->action->reset_filter?></a></li>
						  </ul>
					  </div><!-- /.btn-group left-->
					</h1>
        </div><!-- /.page-header -->
       <!--AJAX Message-->
        <div id="dmessage"></div>
        <!--AJAX Message-->
				<table id="dynamic-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
							<th width="10%" class="center no-sort"> <label class="pos-rel"><input type="checkbox" class="ace" id="check-all" /><span class="lbl"></span> </label></th>
							<th width="10%" class="center"><?=$this->lang->label->id?></th>
              <th width="70%"><?=$this->lang->label->name?></th>
							<th width="10%" class="center no-sort"></th>
            </tr>
          </thead>
          <tbody>
						<?php
							if(is_array($categoryList)){
								foreach($categoryList as $value){
						?>
              <tr>
								<td class="center"><label class="pos-rel"><input id="id_<?=$value['id']?>" name="items" value="<?=$value['id']?>" type="checkbox" class="ace" /><span class="lbl"></span></label></td>
								<td class="center"><?=$value['id']?></td>
                <td><a href="<?=$this->baseurl->front->module->news->category.$value['id']?>" target="_blank"><?=$this->xFunction->htmlspec($value['name'])?></a></td>
							  <td class="center">
									<a href="#modal-edit" onclick="load_form_newstype(<?=$value['id']?>);" data-toggle="modal" data-backdrop="static" data-keyboard="false"  class="btn btn-primary btn-xs btn-action" title="<?=$this->lang->title->edit?>">
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
      </div><!-- /.col-xs-12 -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->
<!-- /plugins -->
<script src="<?=$this->plugins?>check/parsley_th.js" ></script>
<link rel="stylesheet"  href="<?=$this->plugins?>check/parsley.css" />
<script src="<?=$this->plugins?>check/form.js" ></script>
<script src="<?=$this->plugins?>content/autocomplete_off.js" ></script>
<!-- /plugins -->
<!--modal-add-->
<div id="modal-add" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="frm" name="frm" class="form-horizontal" data-parsley-validate="" role="form" method="post">
        <div id="modal-wizard-container">
          <div class="modal-header"><h3><?=$this->lang->page->newstype_add?></h3></div>
          <div class="modal-body step-content">
						<div class="form-group">
              <label class="col-xs-12" >
                <?=$this->lang->label->name?>
              </label>
              <div class="col-xs-12">
                <input id="name" name="name" type="text" class="form-control" required="" />
              </div>
					  </div>
          </div><!--modal-body step-content-->
        </div><!--modal-wizard-container-->
        <div class="modal-footer wizard-actions">
          <!--AJAX Message-->
          <div id="message"></div>
          <!--AJAX Message-->
					<button class="btn btn-success btn-sm btn-next" data-last="Finish" id="loading">
          <i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>
          </button>
          <button class="btn btn-sm pull-left" data-dismiss="modal" id="close-modal">
          <i class="ace-icon fa fa-times"></i> <?=$this->lang->button->close?>
          </button>
          <div class="clearfix"></div>
        </div><!--modal-footer wizard-actions-->
      </form>
    </div><!--modal-content-->
  </div>  <!--modal-dialog-->
</div><!--modal-wizard-->
<!--modal-add-->
<!--modal-edit-->
<div id="modal-edit" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="efrm" name="efrm" class="form-horizontal" data-parsley-validate="" role="form" method="post">
        <div id="modal-wizard-container">
          <div class="modal-header"><h3><?=$this->lang->page->newstype_edit?></h3></div>
          <div class="modal-body step-content">
						<span id="load_html_newstype"></span>
          </div><!--modal-body step-content-->
        </div><!--modal-wizard-container-->
        <div class="modal-footer wizard-actions">
          <!--AJAX Message-->
          <div id="emessage"></div>
          <!--AJAX Message-->
					<button class="btn btn-success btn-sm btn-next" data-last="Finish" id="eloading">
          <i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>
          </button>
          <button class="btn btn-sm pull-left" data-dismiss="modal" id="eclose-modal">
          <i class="ace-icon fa fa-times"></i> <?=$this->lang->button->close?>
          </button>
          <div class="clearfix"></div>
        </div><!--modal-footer wizard-actions-->
      </form>
    </div><!--modal-content-->
  </div>  <!--modal-dialog-->
</div><!--modal-wizard-->
<!--modal-edit-->

<!-- page specific plugin scripts -->
<script src="<?=$this->_assets?>js/jquery.dataTables.min.js"></script>
<script src="<?=$this->_assets?>js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?=$this->_assets?>js/dataTables.responsive.js"></script>
<link rel="stylesheet"  href="<?=$this->_assets?>css/dataTables.responsive.css" />
<script src="<?=$this->_assets?>js/dataTables.buttons.min.js"></script>
<script src="<?=$this->_assets?>js/dataTables.select.min.js"></script>
<script src="<?=$this->_assets?>js/bootbox.js"></script>
<!-- dataTables plugin -->
<script type="text/javascript">
     function load_form_newstype(id){
       $("#load_html_newstype").html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
       $.ajax({
        url : "<?=$this->baseurl->backend->loading?>",
        type: "POST",
        data : {module:'Moderator',load:'newstype',id:id},
        success: function(data, textStatus, jqXHR){
          if(textStatus=='success'){$( "#load_html_newstype" ).html(data);}
        },error: function (jqXHR, textStatus, errorThrown){
          alert('Error!');
          window.location.reload();
        }
       });
     }
    $(function () {
	    $('#frm').parsley().on('field:validated', function() {
	    var ok = $('.parsley-error').length === 0;
	    	$('.bs-callout-info').toggleClass('hidden', !ok);
		    $('.bs-callout-warning').toggleClass('hidden', ok);
	     })
	    .on('form:submit', function() {
			    var formData = new FormData();
			    formData.append('module', 'Moderator');
			    formData.append('action', 'newstype-create');
			    formData.append('name',$("#name").val());
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
			$('#efrm').parsley().on('field:validated', function() {
	    var ok = $('.parsley-error').length === 0;
	    	$('.bs-callout-info').toggleClass('hidden', !ok);
		    $('.bs-callout-warning').toggleClass('hidden', ok);
	     })
	    .on('form:submit', function() {
			    var formData = new FormData();
			    formData.append('module', 'Moderator');
			    formData.append('action', 'newstype-update');
					formData.append('id',$("#eid").val());
			    formData.append('name',$("#ename").val());
			    $( "#eloading").html('<i class="ace-icon fa fa-spinner fa-spin white bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
			    $.ajax({
				    url : "<?=$this->baseurl->backend->process?>",
				    type: "POST",
				    contentType: false,
				    processData: false,
				    data : formData,
				    success: function(data, textStatus, jqXHR)
				    {
				    	if(textStatus=='success'){$( "#emessage" ).html(data);}
				    	$( "#eloading").html('<i class="ace-icon fa fa-floppy-o" aria-hidden="true"></i> <?=$this->lang->button->save?>');
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
			  "select": {"rows": {"_": " <?=$this->lang->dataTables->select_more?>","0": "",}}},'order': [1, 'asc'],select: {style: 'multi',}} );
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
									data : {module:'Moderator',action:'newstype-select-del',items_list:numbers},
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
				  }else{
					  alert("<?=$this->lang->alert->notify->none_select?>");
				  }
			});//#select_items
		});
</script>
