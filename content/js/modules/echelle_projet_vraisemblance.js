
const echelleprojet = document.getElementById('nomechelleprojet');

echelleprojet.addEventListener('change', (event) => {
  $.ajax({
    url: 'content/php/atelier4b/update_echelle_vraisemblance.php',
    type: 'POST',
    data: {
      id_echelle: echelleprojet.value
    },
    success: function (data) {
      location.reload();
    }
  })


});