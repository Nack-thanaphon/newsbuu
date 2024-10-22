<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
        <li><i class="ace-icon fa fa-tachometer"></i> <a href="<?=$this->baseurl->backend->dashboard?>"><?=$this->lang->menu->dashboard?></a></li>
				<li><a href="javascript:void(0)"><?=$this->lang->menu->moderator->main?></a></li>
        <li class="active">รายงานข่าว</li>
      </ul>
		</div>

		<div class="page-content">
			<div class="col-xs-12">
				<div class="page-header">
					<h1>รายงานข่าว</h1>
        </div>// 	<!-- /.page-header -->
				<form id="frm_search" name="frm_search" class="form-horizontal" role="form" method="post" action="">
          <div class="row">
						<div class="col-md-4">
              <div class="input-group">
                <span class="input-group-addon"><b>วันที่</b></span>
								<input type="text" id="sdate" name="sdate" value="" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-addon"><b>หน่วยงาน</b></span>
                <select id="department" name="department" class="form-control" required>
									<option value="">เลือก</option>
									<?php
										 if(is_array($departmentList)){
											 foreach($departmentList as $department){
												 if($department['id']==$_REQUEST['department']){
												 		echo'<option value="'.$department['id'].'" selected>'.$this->xFunction->htmlspec($department['name']).'</option>';
											 		}else{
														echo'<option value="'.$department['id'].'">'.$this->xFunction->htmlspec($department['name']).'</option>';
													}
											 }
										}
									 ?>
                </select>
              </div>
            </div>
           <div class="btn_report col-md-4">
             <button class="btn btn-xs btn-info"  type="submit"><i class="ace-icon fa fa-search" aria-hidden="true"></i> ค้นหา</button>
						 <?php
						  if(!empty($_REQUEST['check_submit'])){
								echo'<a href="'.$this->baseurl->backend->module->print->report.'&sdate='.$_REQUEST['sdate'].'&department='.$_REQUEST['department'].'" class="btn btn-xs btn-success margin_r5" target="_blank"><i class="ace-icon fa fa-print" aria-hidden="true"></i> บริ้น</a>';
							}
						?>
             <input type="hidden" id="check_submit" name="check_submit" value="1" />
           </div>
           <div class="clearfix"></div>
          </div>
        </form><br />
				<?php
					if(!empty($_REQUEST['check_submit'])){
				?>
				<p>รายงานข่าวประจําวันที่เริ่ม <span class="blue"><?=$start?></span> ถึงวันที่ <span class="blue"><?=$end?></span> หน่วยงาน <span class="blue"><?=$this->xFunction->htmlspec($getData['department_name'])?></span> จํานวน <span class="blue"><?=$total?></span> ข่าว</p>
				<table id="dynamic-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
							<th width="10%" class="center">ลําดับที่</th>
							<th width="65%">หัวข้อข่าว/กิจกรรม</th>
              <th width="15%">วันเวลาที่โพส</th>
							<th width="10%" class="center">ผู้โพส</th>
            </tr>
          </thead>
          <tbody>
						<?php
							if(is_array($reportList)){
								if(count($reportList)>0){
									$no=1;
									foreach($reportList as $value){
						?>
              <tr>
								<td class="center"><?=$no?></td>
								<td><a href="<?=$this->baseurl->front->module->news->detail.$value['id']?>" target="_blank"><?=$this->xFunction->htmlspec($value['title'])?></a><br />
								<i class="ace-icon fa fa-clock-o" aria-hidden="true"></i> <?=$this->xFunction->datetimeVIEW($value['news_start'])?></td>
                <td><?=$this->xFunction->datetimeVIEW($value['create_at'])?></td>
								<td><?=$value['fullname']?></td>
              </tr>
						<?php
								$no++;
									}
								}
							}else{ echo'<tr><td colspan="4" class="center">ไม่มีข้อมูล</td><tr>';}
						?>
          </tbody>
        </table>
				<?php
					}
				?>
      </div>// 	<!-- /.col-xs-12 -->
		</div>// 	<!-- /.page-content -->
	</div>
</div>// 	<!-- /.main-content -->

// 	<!-- page specific plugin scripts -->
<script src="<?=$this->plugins?>content/autocomplete_off.js" ></script>
<script type="text/javascript" src="<?=$this->assets?>vendor/datepicker/moment.min.js"></script>
<script type="text/javascript" src="<?=$this->assets?>vendor/datepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$this->assets?>vendor/datepicker/daterangepicker.css" />
// 	<!-- dataTables plugin -->
<script type="text/javascript">
		$(function() {
			$('input[name="sdate"]').daterangepicker({
				 opens: 'left',
				 autoUpdateInput: false,
				 locale: {
						format: 'DD/MM/YYYY',
						cancelLabel: 'Clear',
				 }
			}).val('<?=$_REQUEST['sdate']?>');
			$('input[name="sdate"]').on('apply.daterangepicker', function(ev, picker) {
					$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
			});
			$('input[name="sdate"]').on('cancel.daterangepicker', function(ev, picker) {
					$(this).val('');
			});
		});
</script>
