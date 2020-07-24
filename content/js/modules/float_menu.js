var menu = document.getElementById('menu');

menu.style.display='none';

$(document).on('click', 'a.open_menu', function(e) {
    if(menu.style.display=='inline'){
      menu.style.display='none';
      $('#menu').fadeOut();
    }
    else {
      $('#menu').fadeIn();
      menu.style.display='inline';
    }
});

$(document).on('scroll', function() {
  $('#menu').fadeOut();
  menu.style.display='none';
});