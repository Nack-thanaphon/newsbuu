<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
        <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
				<li><a href="javascript:void(0)"><?=$this->lang->menu->account?></a></li>
        <li class="active"><?=$this->lang->module->account->list?></li>
      </ul>
		</div>

		<div class="page-content">
			<div class="col-xs-12">
				<div class="page-header">
					<h1><?=$this->lang->module->account->list?></h1>
        </div><!-- /.page-header -->
       <!--AJAX Message-->
        <div id="dmessage"></div>
        <!--AJAX Message-->
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th width="10%" class="center"><?=$this->lang->label->id?></th>
              <th width="15%"><?=$this->lang->label->username?></th>
							<th width="20%">ชื่อ-สกุล</th>
							<th width="20%"><?=$this->lang->label->email?></th>
							<th width="10%"><?=$this->lang->label->level?></th>
							<th width="15%" class="center no-sort"><?=$this->lang->label->reset_password?></th>
							<th width="15%" class="center no-sort"><?=$this->lang->label->status?></th>
            </tr>
          </thead>
          <tbody>
					<?php
						if(is_array($accountList)){
							foreach($accountList as $value){
					?>
              <tr>
                <td class="center"><?=$value['id']?></td>
                <td><?=$value['username']?></td>
								<td><?=$value['fullname']?></td>
								<td><?=$value['email']?></td>
                <td><?=$this->xFunction->checkLEVEL($value['level'])?></td>
								<td class="center"><?=$this->xFunction->resetPASS($value['reset_password'])?><a class="reset-password-confirm" id="eloading_<?=$value['id']?>" data-id="<?=$value['id']?>" href="javascript:void(0)"  title="<?=$this->lang->title->reset_password?>"><i class="ace-icon fa fa-refresh bigger-130" aria-hidden="true"></i></a></td>
								<td class="center"><?=$this->xFunction->checkSTATUS($value['status'])?><br /><a class="change-status-confirm" id="sloading_<?=$value['id']?>" data-id="<?=$value['id']?>" href="javascript:void(0)"  title="<?=$this->lang->title->change_status?>"><i class="ace-icon fa fa-retweet bigger-130" aria-hidden="true"></i></a></td>
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
<script src="<?=$this->plugins?>clipboard/clipboard.min.js" ></script>
<script type="text/javascript">
		var clipboard = new Clipboard('.copy');
		clipboard.on('success', function(e) {
			alert('<?=$this->lang->alert->success->copylink?>');
		});
		clipboard.on('error', function(e) {
			alert('Error!');
		});
</script>
<!--Reset Password Form-->
<div id="modal-reset-password" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="efrm" name="efrm" class="form-horizontal">
        <div id="modal-wizard-container">
          <div class="modal-header"><h3><?=$this->lang->page->setPassword?></h3></div>
          <div class="modal-body step-content image-editor">
						<div class="form-group">
              <label class="col-xs-12"><?=$this->lang->label->id?></label>
              <div class="col-xs-12">
               <div class="input-group">
	               <input type="text" id="reset_id" name="reset_id" class="form-control" readonly />
               </div>
              </div>
            </div><!--form-group-->
						<div class="form-group">
              <label class="col-xs-12"><?=$this->lang->label->link_url?></label>
              <div class="col-xs-12">
               <div class="input-group">
	               <input type="text" id="reset_link" name="reset_link" class="form-control" onfocus="this.select()" />
	               <span class="copy input-group-addon" data-clipboard-action="copy" data-clipboard-target="input#reset_link">
		               <i class="fa fa-copy bigger-110"></i> <?=$this->lang->action->btn_copy?>
	               </span>
               </div>
              </div>
            </div><!--form-group-->
          </div><!--modal-body step-content-->
        </div><!--modal-wizard-container-->
        <div class="modal-footer wizard-actions">
          <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal" id="eclose-modal">
          <i class="ace-icon fa fa-times"></i> <?=$this->lang->button->close?>
          </button>
        </div><!--modal-footer wizard-actions-->
      </form>
    </div><!--modal-content-->
  </div>  <!--modal-dialog-->
</div><!--modal-wizard-->
<!--Reset Password Form-->

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
		jQuery(function($) {
				var myTable = $('#dynamic-table').DataTable( {bAutoWidth: false,responsive: true,'columnDefs': [{'targets': 0,'targets': 'no-sort','searchable':false,'orderable':false,}],
			  "stateSave": false,
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
			  "select": {"rows": {"_": " <?=$this->lang->dataTables->select_more?>","0": "",}}},'order': [0, 'desc'],select: {style: 'multi',}} );
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
									data : {module:'Account',action:'change-status',account_id:id},
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
				$('#dynamic-table').on("click", ".reset-password-confirm", function() {
					var id = $(this).data('id');
					$( "#eloading_"+id).html('<i class="ace-icon fa fa-spinner fa-spin red bigger-130"></i>');
					bootbox.confirm({
						message: "<?=$this->lang->alert->confirm->reset_password?>: "+id+" ?",
						buttons: {
						  confirm: { label: "<?=$this->lang->button->confirm?>",className: "btn-primary btn-sm",},
						  cancel: { label: "<?=$this->lang->button->cancel?>",className: "btn-sm pull-left",}},
						callback: function(result) {
							if(result) {
								 $.ajax({
									url : "<?=$this->baseurl->backend->process?>",
									type: "POST",
									data : {module:'Account',action:'reset-password',account_id:id},
									success: function(data, textStatus, jqXHR)
									{
										if(textStatus=='success'){$( "#dmessage" ).html(data);}
										$("#eloading_"+id).html('<i class="ace-icon fa fa-refresh bigger-130" aria-hidden="true"></i>');
									},
									error: function (jqXHR, textStatus, errorThrown)
									{
										alert('Error!');
										window.location.reload();
									}
								});//ajax
							}//result
							$( "#eloading_"+id).html('<i class="ace-icon fa fa-refresh bigger-130" aria-hidden="true"></i>');
						}//callback
					  }	);//.change-status-confirm
				});//.change-status-confirm
		});
</script>
