		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="" class="navbar-brand"><small><?=$this->lang->sitename?></small></a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?=$this->media?>img/default/avatar.jpg" />
								<span class="user-info"><small><?=$this->lang->label->welcome?>,</small> <?=$this->profile->username?></span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li><a href="<?=$this->baseurl->home?>" target="_blank"><i class="ace-icon fa fa-home" aria-hidden="true"></i> <?=$this->lang->home?></a></li>
								<li class="divider"></li>
							  <li><a href="<?=$this->baseurl->backend->module->user->logout?>" onclick="return confirm('<?=$this->lang->alert->confirm->logout?>?')"><i class="ace-icon fa fa-power-off"></i> <?=$this->lang->module->account->logout?></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container"> <!-- /.navbar-container -->
