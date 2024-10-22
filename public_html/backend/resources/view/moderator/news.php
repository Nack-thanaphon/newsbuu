<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
        <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
				<li><a href="javascript:void(0)"><?=$this->lang->menu->news?></a></li>
        <li class="active"><?=$this->lang->module->news->list?></li>
      </ul>
		</div>

		<div class="page-content">
			<div class="col-xs-12">
				<div class="page-header">
					<h1><?=$this->lang->module->news->list?>
					  <div class="btn-group pull-right">
						  <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle" aria-expanded="false" id="sloading">
								 <?=$this->lang->action->menu?> <i class="ace-icon fa fa-angle-down icon-on-right"></i>
						  </button>
						  <ul class="dropdown-menu">
								<li><a href="<?=$this->baseurl->backend->module->news->add?>"><?=$this->lang->action->add?></a></li>
							  <li><a href="javascript:void(0)" id="select_items"><?=$this->lang->action->delete_selected?></a></li>
							  <li><a href="<?=$this->baseurl->backend->module->news->list?>" id="reset_filter_table"><?=$this->lang->action->reset_filter?></a></li>
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
							<th width="5%" class="center no-sort"> <label class="pos-rel"><input type="checkbox" class="ace" id="check-all" /><span class="lbl"></span> </label></th>
              <th width="5%" class="center"><?=$this->lang->label->id?></th>
              <th width="10%" class="center"><?=$this->lang->label->images?></th>
							<th width="10%"><?=$this->lang->label->type?></th>
							<th width="28%"><?=$this->lang->label->title?></th>
							<th width="7%"><?=$this->lang->label->visit?></th>
							<th width="7%" class="center"><?=$this->lang->label->sticky?></th>
							<th width="8%" class="center no-sort"><?=$this->lang->label->status?></th>
							<th width="8%" class="no-sort"><?=$this->lang->label->performer?></th>
							<th width="5%" class="center no-sort"></th>
            </tr>
          </thead>
          <tbody>
						<?php
							if(is_array($newsList)){
								foreach($newsList as $value){
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
									<?php if(!empty($value['thumbnail'])){ ?>
										<a href="<?=$this->mediaURL('news_thumbnail').$value['thumbnail']?>" data-lity>
										 <img src="<?=$this->mediaURL('news_thumbnail').$value['thumbnail']?>"  width="150"  class="bordor" />
										</a>
									<?php }?>
								</td>
								<td><?=$this->xFunction->htmlspec($value['category_name'])?></td>
							  <td>
									<a href="<?=$this->baseurl->front->module->news->detail.$value['id']?>" target="_blank"><?=$this->xFunction->htmlspec($value['title'])?></a><br />
									<i class="ace-icon fa fa-clock-o" aria-hidden="true"></i> <?=$this->xFunction->datetimeVIEW($value['news_start'])?>
								</td>
								<td><?=number_format($value['visit'])?> <?=$this->lang->label->nbcount?></td>
                <td class="center"><?=$this->xFunction->checkICON($value['sticky'])?></td>
								<td class="center"><?=$this->xFunction->checkSTATUS($value['status'])?><br />
									<a class="change-status-confirm" id="sloading_<?=$value['id']?>" data-id="<?=$value['id']?>" href="javascript:void(0)"  title="<?=$this->lang->title->change_status?>">
										<i class="ace-icon fa fa-retweet bigger-130" aria-hidden="true"></i>
									</a>
								</td>
								<td><?=$this->xFunction->icoLEVEL($value['userlevel'])?> <?=$value['username']?></td>
							  <td class="center">
									<a href="<?=$this->baseurl->backend->module->news->view.$value['id'].'&click=moderator'?>" class="btn btn-info btn-xs btn-action" title="<?=$this->lang->title->detail?>">
										<i class="ace-icon fa fa-file-text-o" aria-hidden="true"></i>
									</a>
									<a href="<?=$this->baseurl->backend->module->news->manage.$value['id'].'&click=moderator'?>" class="btn btn-primary btn-xs btn-action" title="<?=$this->lang->title->edit?>">
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

<!-- page specific plugin scripts -->
<link rel="stylesheet"  href="<?=$this->plugins?>lity/dist/lity.css" />
<script src="<?=$this->plugins?>lity/dist/lity.js" ></script>
<script src="<?=$this->_assets?>js/jquery.dataTables.min.js"></script>
<script src="<?=$this->_assets?>js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?=$this->_assets?>js/dataTables.responsive.js"></script>
<link rel="stylesheet"  href="<?=$this->_assets?>css/dataTables.responsive.css" />
<script src="<?=$this->_assets?>js/dataTables.buttons.min.js"></script>
<script src="<?=$this->_assets?>js/dataTables.select.min.js"></script>
<script src="<?=$this->_assets?>js/bootbox.js"></script>
<!-- dataTables plugin -->
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
									data : {module:'News',action:'change-status',news_id:id},
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
											data : {module:'News',action:'select-del',items_list:numbers},
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
