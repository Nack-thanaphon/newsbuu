<script type="text/javascript">try{ace.settings.loadState('main-container')}catch(e){}</script>
<div id="sidebar" class="sidebar  responsive   ace-save-state">
	<script type="text/javascript">try{ace.settings.loadState('sidebar')}catch(e){}</script>
	<ul class="nav nav-list">
		<li><a href="javascript:void(0)"><i class="menu-icon fa fa-clock-o" aria-hidden="true"></i><span class="menu-text"><span id="show_time"></span></span></a></li>
		<li <?=$this->xFunction->checkMENU($_GET['select'],'dashboard')?>>
			<a href="<?=$this->baseurl->dashboard?>"><i class="menu-icon fa fa-tachometer"></i>	<span class="menu-text"> <?=$this->lang->menu->dashboard?> </span></a>
			<b class="arrow"></b>
		</li>
		<?php if($this->checkUID('level')==9 || $this->checkUID('level')==8){?>
		<li <?=$this->xFunction->checkMENU($_GET['select'],'moderator|account|slide')?>>
			<a href="javascript:void(0)" class="dropdown-toggle"><i class="menu-icon fa fa-user-secret" aria-hidden="true"></i><span class="menu-text"> <?=$this->lang->menu->moderator->main?></span><b class="arrow fa fa-angle-down"></b></a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <?=$this->xFunction->checkSUBMENU($_GET['select'],'moderator',$_GET['tab'],'setting')?>><a href="<?=$this->baseurl->backend->module->moderator->setting?>"><i class="menu-icon fa fa-caret-right"></i> <?=$this->lang->menu->moderator->setting?></a><b class="arrow"></b></li>
				<li <?=$this->xFunction->checkSUBMENU($_GET['select'],'account',$_GET['tab'],'list')?>><a href="<?=$this->baseurl->backend->module->account->list?>"><i class="menu-icon fa fa-caret-right"></i> <?=$this->lang->menu->moderator->account?></a><b class="arrow"></b></li>
				<li <?=$this->xFunction->checkSUBMENU($_GET['select'],'moderator',$_GET['tab'],'department')?>><a href="<?=$this->baseurl->backend->module->moderator->department?>"><i class="menu-icon fa fa-caret-right"></i> <?=$this->lang->menu->moderator->department?></a><b class="arrow"></b></li>
				<li <?=$this->xFunction->checkSUBMENU($_GET['select'],'moderator',$_GET['tab'],'newstype')?>><a href="<?=$this->baseurl->backend->module->moderator->newstype?>"><i class="menu-icon fa fa-caret-right"></i> <?=$this->lang->menu->moderator->newstype?></a><b class="arrow"></b></li>
				<li <?=$this->xFunction->checkSUBMENU($_GET['select'],'slide',$_GET['tab'],'list|add|edit|view')?>><a href="<?=$this->baseurl->backend->module->slide->list?>"><i class="menu-icon fa fa-caret-right"></i> <?=$this->lang->menu->moderator->slide?></a><b class="arrow"></b></li>
				<li <?=$this->xFunction->checkSUBMENU($_GET['select'],'moderator',$_GET['tab'],'news')?>><a href="<?=$this->baseurl->backend->module->moderator->news?>"><i class="menu-icon fa fa-caret-right"></i> <?=$this->lang->menu->moderator->news?></a><b class="arrow"></b></li>
				<li <?=$this->xFunction->checkSUBMENU($_GET['select'],'moderator',$_GET['tab'],'images')?>><a href="<?=$this->baseurl->backend->module->moderator->images?>"><i class="menu-icon fa fa-caret-right"></i> <?=$this->lang->menu->moderator->images?></a><b class="arrow"></b></li>
				<li <?=$this->xFunction->checkSUBMENU($_GET['select'],'moderator',$_GET['tab'],'report')?>><a href="<?=$this->baseurl->backend->module->moderator->report?>"><i class="menu-icon fa fa-caret-right"></i> รายงานข่าว</a><b class="arrow"></b></li>
				<li <?=$this->xFunction->checkSUBMENU($_GET['select'],'moderator',$_GET['tab'],'log')?>><a href="<?=$this->baseurl->backend->module->moderator->log?>"><i class="menu-icon fa fa-caret-right"></i> การใช้งานระบบ(Log)</a><b class="arrow"></b></li>
			</ul>
		</li>
	<?php } //check user = moderator ?>
		<li <?=$this->xFunction->checkMENU($_GET['select'],'news',$_GET['click'])?>>
			<a href="javascript:void(0)" class="dropdown-toggle"><i class="menu-icon fa fa-newspaper-o" aria-hidden="true"></i><span class="menu-text"> <?=$this->lang->menu->news?></span><b class="arrow fa fa-angle-down"></b></a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <?=$this->xFunction->checkSUBMENU($_GET['select'],'news',$_GET['tab'],'add|list|manage|view',$_GET['click'])?>><a href="<?=$this->baseurl->backend->module->news->list?>"><i class="menu-icon fa fa-caret-right"></i> <?=$this->lang->module->news->list?></a><b class="arrow"></b></li>
				<li <?=$this->xFunction->checkSUBMENU($_GET['select'],'news',$_GET['tab'],'images',$_GET['click'])?>><a href="<?=$this->baseurl->backend->module->news->images?>"><i class="menu-icon fa fa-caret-right"></i> <?=$this->lang->module->news->images?></a><b class="arrow"></b></li>
			</ul>
		</li>
	</ul><!-- /.nav-list -->
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse"><i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i></div>
</div><!-- /.sidebar-->
