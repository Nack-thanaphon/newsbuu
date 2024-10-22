 <!-- Start Breadcrumbs -->
<?php
$breadcrumbs = '';
if ($this->data['web_config']['breadcrumbs']) {
	$breadcrumbs = $this->mediaURL('breadcrumbs') . $this->data['web_config']['breadcrumbs'];
} else {
	$breadcrumbs = $this->mediaURL('breadcrumbs') . 'default.jpg';
}
?>
<section class="breadcrumbs overlay" style="background-image:url('<?= $breadcrumbs ?>')">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2><?= $h2_title ?></h2>
				<ul class="bread-list">
					<li><a href="<?= $this->baseurl->home ?>"><?= $this->lang->front->home ?><i class="fa fa-angle-right"></i></a></li>
					<li class="active"><a href="<?= $this->baseurl->front->module->news->list ?>"><?= $this->lang->front->news ?></a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!--/ End Breadcrumbs -->

 <!-- Events -->
<section class="events archives section">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-12 col-md-10 col-xl-8 mb-4">
				<form class="search" method="post" action="">
					<div class="form-row">
						<div class="col-12 col-md-6 mt-2 mb-1 mt-md-1">
							<input type="text" id="sdate" name="sdate" value="<?= $_REQUEST['sdate'] ?>" class="form-control" placeholder="<?= $this->lang->placeholder->search_date ?>">
						</div>
						<div class="col-12 col-md-6 mt-2 mb-1 mt-md-1">
							<input type="text" name="q" id="q" value="<?= $_REQUEST['q'] ?>" class="form-control" placeholder="<?= $this->lang->placeholder->search_title ?>">
							<button class="button" type="submit"><i class="fa fa-search"></i></button>
							<input type="hidden" name="d" id="d" value="<?= $_REQUEST['d'] ?>">
							<input type="hidden" name="c" id="c" value="<?= $_REQUEST['c'] ?>">
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<?php
			if (is_array($newsList)) {
				$news_thumbnail = '';
				foreach ($newsList as $items_value) {
					if (!empty($items_value['thumbnail'])) {
						$news_thumbnail = $this->mediaURL('news_thumbnail') . $items_value['thumbnail'];
					} else {
						$news_thumbnail = $this->media . 'img/default/no_images.jpg';
					}
					$news_html = '';
					$news_html .= '<div class="col-lg-4 col-md-6 col-12">';
					$news_html .= '<div class="single-event">';
					$news_html .= '<div class="head overlay">';
					$news_html .= $this->xFunction->check7DAYS($items_value['news_date']);
					$news_html .= '<img src="' . $news_thumbnail . '" alt="' . $this->xFunction->htmlspec($items_value['title']) . '">';
					$news_html .= '<a target="_new" href="' . $this->baseurl->front->module->news->detail . $items_value['id'] . '" class="btn"><i class="fa fa-search"></i></a>';
					$news_html .= '</div>';
					$news_html .= '<div class="event-content">';
					$news_html .= '<div class="meta">';
					$news_html .= '<span><i class="fa fa-calendar"></i> ' . $this->xFunction->thaidate($items_value['news_date']) . '</span>';
					$news_html .= '<span><i class="fa fa-list-alt"></i> ' . $this->xFunction->htmlspec($items_value['category_name']) . '</span>';
					$news_html .= '</div>';
					$news_html .= '<h4><a target="_new" href="' . $this->baseurl->front->module->news->detail . $items_value['id'] . '">' . $this->xFunction->htmlspec($items_value['title']) . '</a></h4>';
					$news_html .= '<p>' . $this->xFunction->htmlspec($items_value['overview']) . '</p>';
					$news_html .= '<div class="button">';
					$news_html .= '<a target="_new" href="' . $this->baseurl->front->module->news->detail . $items_value['id'] . '" class="btn">' . $this->lang->label->read_more . '</a>';
					$news_html .= '</div></div></div></div>';
					echo $news_html;
				}
			}
			?>
		</div>
		<div class="row">
			<?php if (is_array($newsList) && $total_items > 0) { ?>
				<div class="col-12"><!--pagination_content-->
					<div class="pagination_content">
						<div class="col-12 col-sm-8 pagination_left"><!--left-->
							<div class="row"><!--row-->
								<div class="pagination_perpage">
									<ul class="perpage_nav">
										<?php
										$this->xFunction->page_navigator($before_p, $plus_p, $total_p, $check_page, $search_nav);
										?>
									</ul>
								</div>
							</div>
						</div><!--left-->
						<div class="col-12 col-sm-4 pagination_right"><!--right-->
							<div class="pages_navi pull-right">
								<div class="row pull-left">
									<?= $click_prev ?>
								</div>
								<div class="row pull-right">
									<?= $click_next ?>
								</div>
							</div>
							<div class="pages_navi_txt"><?= $this->lang->label->page ?> <?= $current_page ?> <span><?= $this->lang->label->from ?> <?= $total_p ?></span></div>
						</div><!--right-->
						<div class="clear"></div>
					</div><!--nav-pages-content-->
				</div><!--nav-pages-content-->
			<?php } ?>
		</div>
	</div>
</section>
<!--/ End Events -->
<!-- Include jQuery -->
<!-- Include Date Range Picker -->
<script src="<?= $this->plugins ?>content/autocomplete_off.js"></script>
<script type="text/javascript" src="<?= $this->assets ?>vendor/datepicker/moment.min.js"></script>
<script type="text/javascript" src="<?= $this->assets ?>vendor/datepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= $this->assets ?>vendor/datepicker/daterangepicker.css" />
<script type="text/javascript">
	$(function() {
		$('input[name="sdate"]').daterangepicker({
			opens: 'left',
			autoUpdateInput: false,
			locale: {
				format: 'DD/MM/YYYY',
				cancelLabel: 'Clear',
			}
		}).val('<?= $_REQUEST['sdate'] ?>');
		$('input[name="sdate"]').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
		});
		$('input[name="sdate"]').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
	});
</script>