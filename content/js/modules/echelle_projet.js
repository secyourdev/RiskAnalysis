
const echelleprojet = document.getElementById('nomechelleprojet');

echelleprojet.addEventListener('change', (event) => {
  $.ajax({
    url: 'content/php/atelier1c/update_echelle.php',
    type: 'POST',
    data: {
      id_echelle: echelleprojet.value
    },
    success: function (data) {
      location.reload();
    }
  })


});