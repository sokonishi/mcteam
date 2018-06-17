 jQuery(function($) {

$(document).ready( function() {


  	// Portfolio Isotope Filter
    $(window).load(function() {
        var $items = $('.portfolio-items');
        $('.timeline_card').css("padding" , "20px");
        $items.isotope({
            filter: '.timeline_card',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
        $('.cat a').click(function() {
            $('.cat .active').removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            $(selector).css("padding" , "20px");
            $items.isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            return false;
        });

    });

  });
});
