
const vraisemblance = document.getElementById('valeurvraisemblance');

vraisemblance.addEventListener('change', (event) => {
  //   const result = document.querySelector('.result');
  //   console.log(`Valeur  ${selectechelle.value}`);
  $.ajax({
    url: 'content/php/atelier4b/update_vraisemblance.php',
    type: 'POST',
    data: {
      vraisemblance: vraisemblance.value
    },
    success: function (data) {
        // console.log(data);
        document.getElementById('vraisemblance_choisie').innerHTML = "Valeur de vraisemblance choisie : " + vraisemblance.value;
 
    location.reload();
    }
  })


});