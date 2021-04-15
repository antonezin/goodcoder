

if(window.innerWidth < 1100){
	var header = $('.header'),
		scrollPrev = 0;

	$(window).scroll(function() {
		var scrolled = $(window).scrollTop();
	 
		if ( scrolled > 70 && scrolled > scrollPrev ) {
			header.addClass('fix_head');
			header.removeClass('fix');
		} else {
			header.removeClass('fix_head');
			header.addClass('fix');
		}
		scrollPrev = scrolled;
	});
}



jQuery(function($) {
		        $(window).scroll(function(){
		            if($(this).scrollTop()>110){
		                $('#items').addClass('fixed');
		            }
		            else if ($(this).scrollTop()<110){
		                $('#items').removeClass('fixed');
		            }
		        });
		    });




$('.burger__button').click(function() {
  $('.menu__mobile__burger').toggleClass('active');
  $('.burger__button').toggleClass('active-button');
});


$(document).ready(function() {
  $(window).scroll(function() {
    	$('.menu__mobile__burger').removeClass('active');
    	$('.burger__button').removeClass('active-button');
  });
});

