
const selectpp = document.getElementById('partieprenante1');

selectpp.addEventListener('change', (event) => {
  $.ajax({
    url: 'content/php/atelier3c/chemins.php',
    type: 'POST',
    data: {
      pp: selectpp.value
    },
    success: function (data) {
      document.getElementById('chemins').innerHTML = data;
    }
  })


});