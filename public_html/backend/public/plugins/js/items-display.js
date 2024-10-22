// JavaScript Document

var expires_date = new Date();
expires_date.setTime(expires_date.getTime() + 1 * (24 * 60 * 60 * 1000));
function display(view) {
	$('.list-view .btn').removeClass('active');
	if(view == 'grid'){
		$('.product-view .items-grid').removeClass('col-lg-12 items_list');
		$('.product-view .grid-box').removeClass('box_list');
		$('.product-view .items').removeClass('col-md-9 items_viewlist');
		$('.product-view .items_photo').removeClass('col-md-4 photo_viewlist');
		$('.product-view .items_detail').removeClass('col-md-8 detail_viewlist');
		$('.product-view .items_overview').addClass('hidden');
		$('.product-view .items_compare').removeClass('col-md-3 compare_viewlist');
		$('.list-view .' + view).addClass('active');
		$.cookie('display','grid', { expires: expires_date, path: '/' });
	}
	if(view == 'list') {
		$('.product-view .items-grid').addClass('col-lg-12 items_list');
		$('.product-view .grid-box').addClass('box_list');
		$('.product-view .items').addClass('col-md-9 items_viewlist');
		$('.product-view .items_photo').addClass('col-md-4 photo_viewlist');
		$('.product-view .items_detail').addClass('col-md-8 detail_viewlist');
		$('.product-view .items_overview').removeClass('hidden');
		$('.product-view .items_compare').addClass('col-md-3 compare_viewlist');
		$('.list-view .' + view).addClass('active');
		$.cookie('display','list', { expires: expires_date, path: '/' });
	}
}

$(document).ready(function () {
	$(function(){
			 if($.cookie('display') == 'list'){ 
				 display('list');
			 }else if($.cookie('display') == 'grid'){ 
				 display('grid');
			}else{
				display('grid');
			}
	});

	// Click Button
	$('.list-view .btn').each(function() {
		var ua = navigator.userAgent,
		event = (ua.match(/iPad/i)) ? 'touchstart' : 'click';
		$(this).bind(event, function() {
			$(this).addClass(function() {
				if($(this).hasClass('active')) return ''; 
				return 'active';
			});
			$(this).siblings('.btn').removeClass('active');
			$catalog_mode = $(this).data('view');
			if($catalog_mode=='grid'){
				$.cookie('display','grid', { expires: expires_date, path: '/' });
			}else if($catalog_mode=='list'){
				$.cookie('display','list', { expires: expires_date, path: '/' });

			}else{
				$.cookie('display','grid', { expires: expires_date, path: '/' });
			}
			display($catalog_mode);
		});
	});
});