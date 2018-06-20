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

    $(".hoge").on('click', function() {
        var post_id = $(this).siblings('.fuga').val();
        action(post_id, $(this));


    });

      function action(post_id, btn){
        console.log(1);
        $.ajax({
          type: "GET",
          url: "like.php",
          data: {
            id: post_id
          },
          success: function(data) {
            // unlike ボタンを表示する
            // $("p.likebox").html("<h1>gya</h1>");
            console.log("success");
            $("#feed_"+post_id).text(data + "件");
            $("#ranking_"+post_id).text(data + "件");
            $("#my_"+post_id).text(data + "件");
            btn.siblings('.ika').show();
            btn.hide();
          }
        });
      }

      // unlike
    $(".ika").on('click', function() {
        var post_id = $(this).siblings('.fuga').val();
        unlike(post_id, $(this));


    });

      function unlike(post_id, btn){
        console.log(1);
        $.ajax({
          type: "GET",
          url: "unlike.php",
          data: {
            id: post_id
          },
          success: function(data) {
            // unlike ボタンを表示する
            // $("p.likebox").html("<h1>gya</h1>");
            console.log("success");
            $("#feed_"+post_id).text(data + "件");
            $("#ranking_"+post_id).text(data + "件");
            $("#my_"+post_id).text(data + "件");
            btn.siblings('.hoge').show();
            btn.hide();
          }
        });
      }
        });
      }
  });
});
