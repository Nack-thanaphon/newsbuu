<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
        <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->backend->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
				<li><a href="javascript:void(0)"><?=$this->lang->menu->moderator->main?></a></li>
        <li class="active">การใช้งานระบบ(Log)</li>
      </ul>
		</div>

		<div class="page-content">
			<div class="col-xs-12">
				<div class="page-header">
					<h1>การใช้งานระบบ(Log)</h1>
        </div>// 	<!-- /.page-header -->
       <!--AJAX Message-->
        <div id="dmessage"></div>
        <!--AJAX Message-->
				<table id="dynamic-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
							<th width="10%" class="center">รหัส</th>
							<th width="20%">เมื่อ</th>
              <th width="10%">ผู้ใช้</th>
							<th width="10%" class="center">สถานะ</th>
							<th width="50%">รายละเอียด</th>
            </tr>
          </thead>
          <tbody>
						<?php
							if(is_array($logList)){
								foreach($logList as $value){
						?>
              <tr>
								<td class="center"><?=$value['id']?></td>
								<td ><?=date("d/m/Y H:i:s",strtotime($value['create_at']))?></td>
                <td><?=$value['fullname']?></td>
								<td class="center"><?=$this->xFunction->checkLOG($value['status'])?></td>
								<td><?=$this->xFunction->htmlspec($value['note'])?></td>
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

// 	<!-- page specific plugin scripts -->
<script src="<?=$this->_assets?>js/jquery.dataTables.min.js"></script>
<script src="<?=$this->_assets?>js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?=$this->_assets?>js/dataTables.responsive.js"></script>
<link rel="stylesheet"  href="<?=$this->_assets?>css/dataTables.responsive.css" />
<script src="<?=$this->_assets?>js/dataTables.buttons.min.js"></script>
<script src="<?=$this->_assets?>js/dataTables.select.min.js"></script>
// 	<!-- dataTables plugin -->
<script type="text/javascript">
		jQuery(function($) {
				var myTable = $('#dynamic-table').DataTable( {bAutoWidth: false,responsive: true,'columnDefs': [{'targets': 0,'targets': 'no-sort','searchable':false,'orderable':false,}],
			  "stateSave": false,
				"pageLength": 50,
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
		});
</script>
