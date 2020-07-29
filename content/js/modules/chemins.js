
const selectpp = document.getElementById('partieprenante1');

selectpp.addEventListener('change', (event) => {
  //   const result = document.querySelector('.result');
  //   console.log(`Valeur  ${selectechelle.value}`);
  $.ajax({
    url: 'content/php/atelier3c/chemins.php',
    type: 'POST',
    data: {
      pp: selectpp.value
    },
    success: function (data) {
        // console.log(data);
      document.getElementById('chemins').innerHTML = data;
    }
  })


});