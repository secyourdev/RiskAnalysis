const nomprojet = document.getElementById('nomprojet');
var button_add_version = document.getElementById('button_add_version')

nomprojet.selectedIndex = sessionStorage.getItem('nomprojet')
rechercher_version(nomprojet.value);

nomprojet.addEventListener('change', function(){
  sessionStorage.setItem('nomprojet',nomprojet.selectedIndex);
  rechercher_version(nomprojet.options[nomprojet.options.selectedIndex].value);
});

function rechercher_version(selected_value){
  $.ajax({
    url: 'content/php/accueil/selection_version.php',
    type: 'POST',
    data: {
      id_projet : selected_value
    },
    success: function (data) {
      document.getElementById('ecrire_version').innerHTML = data;
      $('#tableau_version').Tabledit({
        deleteButton: true,
        editButton:true,
        url: 'content/php/accueil/modification_version.php',
        columns: {
          identifier: [0, "id_version"],
          editable: [[1, 'num_version'], [2, 'description_version']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
          if (data.action == 'delete') {
            $('#' + data.id_version).remove();
          }
        }
      });
    }
  })
  sleep(100).then(() => {
    if(selected_value!="")
      button_add_version.style.display='inline'
    else
      button_add_version.style.display='none'
  });
}

$(document).ready(function () {
  $('#editable_table').Tabledit({
      url: 'content/php/atelier2a/modification.php',
      columns: {
          identifier: [0, 'id_source_de_risque'],
          editable: [
              [1, 'type_d_attaquant_source_de_risque', '{"Organisation structurée" : "Organisation structurée", "Organisation idéologique" : "Organisation idéologique", "Individu isolé" : "Individu isolé"}'],
              [2, 'profil_de_l_attaquant_source_de_risque'],
              [3, 'description_source_de_risque'], 
              [4, 'objectif_vise'],
              [5, 'description_objectif_vise']
          ],
      },
      restoreButton: false,
      onSuccess: function (data, textStatus, jqXHR) {
          if (data.action == 'delete') {
              $('#' + data.id_source_de_risque).remove();
          }
      }
  });
});