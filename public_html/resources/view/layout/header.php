		// 	<!-- Header -->
		<header class="header">
			// 	<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-12">
							<div class="logo">
								<a href="<?=$this->baseurl->home?>"><img src="<?=$this->assets?>images/logo.png" alt="<?=$this->lang->meta_title?>"></a>
							</div>
							<div class="mobile-menu"></div>
						</div>
						<div class="col-lg-9 col-md-9 col-12">
							// 	<!-- Header Widget -->
							<div class="header-widget">
								<div class="single-widget">
									<i class="fa fa-phone"></i>
									<h4><?=$this->lang->label->phone?><span><?=$this->phone?></span></h4>
								</div>
								<div class="single-widget">
									<i class="fa fa-envelope-o"></i>
									<h4><?=$this->lang->label->email?><a href="mailto:<?=$this->email?>"><span><?=$this->email?></span></a></h4>
								</div>
								<div class="single-widget">
									<i class="fa fa-map-marker"></i>
									<h4><?=$this->lang->address?></h4>
								</div>
							</div>
							<!--/ End Header Widget -->
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
			// 	<!-- Header Menu -->
			<div class="header-menu">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<nav class="navbar navbar-default">
								<div class="navbar-collapse">
									// 	<!-- Main Menu -->
									<ul id="nav" class="nav menu navbar-nav">
										<li <?php if(empty($_GET['select'])){ echo'class="active" '; }?>><a href="<?=$this->baseurl->home?>"><?=$this->lang->front->home?></a></li>
										<li <?php if(!empty($_GET['d']) && empty($_GET['c'])){ echo'class="active" '; }?>><a href="javascript:void(0)"><?=$this->lang->front->department?><i class="fa fa-angle-down"></i></a>
											<ul class="dropdown">
												<?php if(is_array($this->data['department'])){ foreach($this->data['department'] as $depKeys=>$department){echo '<li><a href="'.$this->baseurl->front->module->news->department.$depKeys.'">'.$department.'</a></li>';}} ?>
											</ul>
										</li>
										<li <?php if(!empty($_GET['c']) && empty($_GET['d'])){ echo'class="active" '; }?>><a href="javascript:void(0)"><?=$this->lang->front->newtype?><i class="fa fa-angle-down"></i></a>
											<ul class="dropdown">
												<?php if(is_array($this->data['newstype'])){foreach($this->data['newstype'] as $depKeys=>$department){echo '<li><a href="'.$this->baseurl->front->module->news->category.$depKeys.'">'.$department.'</a></li>';}} ?>
											</ul>
										</li>
										<li <?php if(!empty($_GET['select']) && $_GET['select']=='search'){ echo'class="active" '; }?>><a href="<?=$this->baseurl->front->module->search->list?>">ค้นหาข่าวย้อนหลัง</a></li>
									</ul>
									// 	<!-- End Main Menu -->
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Menu -->
		</header>
		// 	<!-- End Header -->
