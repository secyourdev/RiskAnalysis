
const selectechelle = document.getElementById('nomechelle');

selectechelle.selectedIndex = sessionStorage.getItem('selectechelle')
selectEchelle(selectechelle.value);

selectechelle.addEventListener('change', (event) => {
  sessionStorage.setItem('selectechelle',selectechelle.selectedIndex);
  selectEchelle(selectechelle.options[selectechelle.options.selectedIndex].value);
});

function selectEchelle(selected_value){
  $.ajax({
    url: 'content/php/echelle/niveau.php',
    type: 'POST',
    data: {
      nom_echelle: selected_value
    },
    success: function (data) {
      document.getElementById('ecrire_niveau').innerHTML = data;
      $('#tableau_niveau').Tabledit({
        deleteButton: false,
        editButton:true,
        url: 'content/php/echelle/modificationniveau.php',
        columns: {
          identifier: [0, "id_niveau"],
          editable: [[2, 'description_niveau']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
          if (data.action == 'delete') {
            $('#' + data.id_niveau).remove();
          }
        }
      });
    }
  })
}