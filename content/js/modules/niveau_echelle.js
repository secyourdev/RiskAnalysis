
const selectechelle = document.getElementById('nomechelle');

selectechelle.addEventListener('change', (event) => {
  //   const result = document.querySelector('.result');
  //   console.log(`Valeur  ${selectechelle.value}`);
  $.ajax({
    url: 'content/php/echelle/niveau.php',
    type: 'POST',
    data: {
      nom_echelle: selectechelle.value
    },
    success: function (data) {
      //   console.log(data);
      document.getElementById('ecrire_niveau').innerHTML = data;
      $('#tableau_niveau').Tabledit({
        deleteButton: false,
        url: 'content/php/echelle/modificationniveau.php',
        columns: {
          identifier: [0, "id_niveau"],
          editable: [[2, 'description_niveau']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
          if (data.action == 'delete') {
            $('#' + data.id_valeur_metier).remove();
          }
        }
      });
    }
  })


});