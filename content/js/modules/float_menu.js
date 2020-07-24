document.getElementById('menu').style.display='none';

$(document).on('click', 'a.open_menu', function(e) {
    if(document.getElementById('menu').style.display=='inline') document.getElementById('menu').style.display='none';
    else document.getElementById('menu').style.display='inline';
  });

  $(document).on('scroll', function() {
    document.getElementById('menu').style.display='none';
  });