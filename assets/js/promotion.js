$(function(){

  $('.content_hover').hover(
    function(){
      $(this).find('.signup-header').addClass('effective');
    },
    function(){
      $(this).find('.signup-header').removeClass('effective');
    }
    )

    $(window).on('scroll', function() {
		var scroll = $(window).scrollTop();

		if (scroll >= 700) {
			$('.header_hover').addClass('fixed');
			$('#header_img').hide();
			$('#header_img2').show();
		} else {
			$('.header_hover').removeClass('fixed');
			$('#header_img2').hide();
			$('#header_img').show();
		}
	});

	


})