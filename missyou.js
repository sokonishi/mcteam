
$(function(){

  $('.card_hover').hover(
    function(){
      $(this).$('.card_contents').addClass('card_active');
    },
    function(){
      $(this).$('.card_contents').removeClass('card_active');
    }

    )

})
