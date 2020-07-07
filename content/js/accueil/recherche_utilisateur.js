const nomgrpuser = document.getElementById('nomgrpuser');
var button_add_user_in_grp = document.getElementById('button_add_user_in_grp')

nomgrpuser.addEventListener('change', (event) => {
  $.ajax({
    url: 'content/php/accueil/selection_utilisateur.php',
    type: 'POST',
    data: {
        nom_grp_utilisateur: nomgrpuser.value
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
  if(nomgrpuser.options[nomgrpuser.options.selectedIndex].value!="")
    button_add_user_in_grp.style.display='inline'
  else
    button_add_user_in_grp.style.display='none'
});


