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

            // comment_ajax
      $(".tukkomi").on('click', function() {
      var feed_id = $(this).siblings('.boke').val();
      // var comment_name = $(this).siblings('.dare').val();
      // var img_name = $(this).siblings('.takutoimg').val();
      var comment_feed = $(this).siblings('.comment').val();
      comment(feed_id, comment_feed);
      // console.log(feed_id, comment_name, img_name, comment_feed);
      });

      function comment(feed_id, comment){
        $.ajax({
          type: "GET",
          url: "comment_ajax.php",
          data: {
            id: feed_id,
            comment: comment
          },
          success: function(data) {
            data_arr = JSON.parse(data);
            console.log(data);
            // console.log(data_arr.img_name);
            // console.log(data.comment);
            // console.log(data.[0]);
            // console.log(data[5]);
            // console.log(data[6]);
            // console.log(data[7]);
            $('.masumi').prepend(
              '<div class="row comment_box">' +
                '<div class="col-xs-12">' +
                  '<div class="col-xs-4">' +
                    '<img src="user_profile_img/' + data_arr.img_name + '" class="profile_img" >' +
                  '</div>' +
                  '<div class="col-xs-8">' +
                    '<h4>' + data_arr.name + '</h4>' +
                    '<p class="text-muted">'+ data_arr.created +'</p>' +
                    '<div class="row comment_content">' +
                      '<div class="col-xs-12">' +
                        '<p>'+ comment +'</p>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>'
              );
          }
        });
      }
  });
});
