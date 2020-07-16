const nomgrpuser = document.getElementById('nomgrpuser');
var button_add_user_in_grp = document.getElementById('button_add_user_in_grp')

nomgrpuser.selectedIndex = sessionStorage.getItem('nomgrpuser')
rechercher_utilisateur(nomgrpuser.value);

nomgrpuser.addEventListener('change', function(){
  sessionStorage.setItem('nomgrpuser',nomgrpuser.selectedIndex);
  rechercher_utilisateur(nomgrpuser.options[nomgrpuser.options.selectedIndex].value);
});


function rechercher_utilisateur(selected_value){
  $.ajax({
    url: 'content/php/accueil/selection_utilisateur.php',
    type: 'POST',
    data: {
        nom_grp_utilisateur: selected_value
    },
    success: function (data) {
      document.getElementById('ecrire_user').innerHTML = data;
      $('#tableau_user').Tabledit({
        deleteButton: true,
        editButton:false,
        url: 'content/php/accueil/modification_utilisateur.php',
        columns: {
          identifier: [0, "id_utilisateur"],
          editable: []
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
          if (data.action == 'delete') {
            $('#' + data.id_utilisateur).remove();
          }
        }
      });
    }
  })
  sleep(100).then(() => {
    if(selected_value!="")
      button_add_user_in_grp.style.display='inline'
    else
      button_add_user_in_grp.style.display='none'
  });
}