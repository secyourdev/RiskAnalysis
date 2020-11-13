const selectechelle = document.getElementById('nomechelle');

selectechelle.selectedIndex = sessionStorage.getItem('selectechelle')
selectEchelle(selectechelle.value);

selectechelle.addEventListener('change', (event) => {
  sessionStorage.setItem('selectechelle',selectechelle.selectedIndex);
  selectEchelle(selectechelle.options[selectechelle.options.selectedIndex].value);
});

function selectEchelle(selected_value){
  $.ajax({
    url: 'content/php/echelle/niveau_vraisemblance.php',
    type: 'POST',
    data: {
      nom_echelle: selected_value
    },
    success: function (data) {
      document.getElementById('ecrire_niveau').innerHTML = data;
      $('#tableau_niveau').Tabledit({
        url: 'content/php/echelle/modification_niveau_vraisemblance.php',
        columns: {
          identifier: [0, "id_niveau"],
          editable: []
        },
        editButton: false,
        deleteButton: false,
        restoreButton: false
      });
    }
  })
}