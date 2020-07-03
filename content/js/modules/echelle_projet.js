
const echelleprojet = document.getElementById('nomechelleprojet');

echelleprojet.addEventListener('change', (event) => {
  //   const result = document.querySelector('.result');
  //   console.log(`Valeur  ${selectechelle.value}`);
  $.ajax({
    url: 'content/php/atelier1c/update_echelle.php',
    type: 'POST',
    data: {
      nom_echelle: echelleprojet.value
    },
    success: function (data) {
        console.log(data);
      document.getElementById('echelle_choisie').innerHTML = "Echelle choisie : " + data;
      // $('#tableau_niveau').Tabledit({
      //   deleteButton: false,
      //   url: 'content/php/echelle/modificationniveau.php',
      //   columns: {
      //     identifier: [0, "id_niveau"],
      //     editable: [[2, 'description_niveau']]
      //   },
      //   restoreButton: false,
      //   onSuccess: function (data, textStatus, jqXHR) {
      //     if (data.action == 'delete') {
      //       $('#' + data.id_valeur_metier).remove();
      //     }
      //   }
      // });
    }
  })


});