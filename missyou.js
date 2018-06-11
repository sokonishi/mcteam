$(function(){

  $('.card_hover').hover(
    function(){
      $(this).find('.card_contents').addClass('card_active');
      $(this).find('.card_img').addClass('card_active2')
    },
    function(){
      $(this).find('.card_contents').removeClass('card_active');
      $(this).find('.card_img').removeClass('card_active2');
    }
    )

  $('.card_click').click(
    function(){
      $('.comment_timeline').fadeIn();
    })

})
