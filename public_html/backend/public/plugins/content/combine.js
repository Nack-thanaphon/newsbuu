// JavaScript Document
$(function(){
  var $searchlink = $('#searchtoggl i');
  var $searchbar  = $('#searchbar');
  $('ul.navbar-nav li a').on('click', function(e){
    e.preventDefault();
    if($(this).attr('id') == 'searchtoggl') {
      if(!$searchbar.is(":visible")) { 
        $searchlink.removeClass('fa-search').addClass('fa-search-minus');
      } else {
        $searchlink.removeClass('fa-search-minus').addClass('fa-search');
      }
      $searchbar.slideToggle(300, function(){
      });
    }
  });  
});
