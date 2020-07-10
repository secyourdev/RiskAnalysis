
const selectref = document.getElementById('referentiel');
console.log(selectref.value);
selectref.addEventListener('change', (event) => {
  //   const result = document.querySelector('.result');
  //   console.log(`Valeur  ${selectechelle.value}`);
  $.ajax({
    url: 'content/php/atelier3c/regles.php',
    type: 'POST',
    data: {
      ref: selectref.value
    },
    success: function (data) {
        // console.log(data);
      document.getElementById('mesure').innerHTML = data;
    }
  })


});