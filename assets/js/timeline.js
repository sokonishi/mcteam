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
      var comment_feed = $(this).siblings('.comment').val();
      comment(feed_id, comment_feed);
      console.log(feed_id, comment_feed)
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
            console.log(data);
            $('.masumi').prepend(
              '<div class="row comment_box">' +
                '<div class="col-xs-12">' +
                  '<div class="col-xs-4">' +
                    // '<img src="user_profile_img/<?php echo $users_record["img_name"] ?>" class="profile_img" >' +
                  '</div>' +
                  '<div class="col-xs-8">' +
                    // '<h4><?php echo $users_record["img_name"] ?></h4>' +
                    // '<p>'+ comment +'</p>' +
                    '<p>'+ comment +'</p>' +
                  '</div>' +
                '</div>' +
              '</div>'
              );
            // $("#view_feed_"+view_id).text(data + "件");
          }
        });
      }
  });
});
