
const selectref = document.getElementById('referentiel');
selectref.addEventListener('change', (event) => {

  $.ajax({
    url: 'content/php/atelier3c/regles.php',
    type: 'POST',
    data: {
      ref: selectref.value
    },
    success: function (data) {
      document.getElementById('mesure').innerHTML = data;
    }
  })


});