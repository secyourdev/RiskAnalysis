
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
    //   $('#tableau_er').Tabledit({
    //     url: 'content/php/atelier1c/modification.php',
    //     sortable: true,
    //     columns: {
    //         identifier: [0, 'id_evenement_redoute'],
    //         editable: [
    //             [1, 'nom_valeur_metier'],
    //             [2, 'nom_evenement_redoute'],
    //             [3, 'description_evenement_redoute'],
    //             [4, 'impact'], 
    //             [5, 'confidentialite', '{"1" : "1", "2" : "2", "3" : "3"}'],
    //             [6, 'integrite', '{"1" : "1", "2" : "2", "3" : "3"}'],
    //             [7, 'disponibilite', '{"1" : "1", "2" : "2", "3" : "3"}'],
    //             [8, 'tracabilite', '{"1" : "1", "2" : "2", "3" : "3"}'],
    //             [9, 'niveau_de_gravite']
    //         ],
    //     },
    //     restoreButton: false,
    //     onSuccess: function (data, textStatus, jqXHR) {
    //         if (data.action == 'delete') {
    //             $('#' + data.id_evenement_redoutes).remove();
    //         }
    //     }
    // });
    location.reload();
    }
  })


});