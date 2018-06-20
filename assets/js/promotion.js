$(function(){

  $('.content_hover').hover(
    function(){
      $(this).find('.signup-header').addClass('effective');
    },
    function(){
      $(this).find('.signup-header').removeClass('effective');
    }
    )


})