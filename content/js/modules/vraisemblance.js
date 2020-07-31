
const vraisemblance = document.getElementById('valeurvraisemblance');

vraisemblance.addEventListener('change', (event) => {
  $.ajax({
    url: 'content/php/atelier4b/update_vraisemblance.php',
    type: 'POST',
    data: {
      vraisemblance: vraisemblance.value
    },
    success: function (data) {
        location.reload();
    }
  })


});