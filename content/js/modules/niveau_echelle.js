
const selectechelle = document.getElementById('nomechelle');

selectechelle.addEventListener('change', (event) => {
//   const result = document.querySelector('.result');
  console.log(`Valeur  ${selectechelle.value}`);
  $.ajax({
      url: 'content/php/echelle/niveau.php',
      type: 'POST',
      data: {
          nom_echelle: selectechelle.value
      },
      success: function(data){
          console.log(data);
          document.getElementById('ecrire_niveau').outerHTML = data; 
      }
  })
});