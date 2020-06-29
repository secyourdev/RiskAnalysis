/*------------------------------- VARIABLES ----------------------------------*/
var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function(){  
    $('#editable_table').Tabledit({
     url:'content/php/compte/modification.php',
     columns:{
      identifier:[0, "id_utilisateur"],
      editable:[[1, 'nom'], [2, 'prenom'], [3, 'poste'], [4, 'email'], [5, 'type_compte','{"Administrateur Logiciel":"Administrateur Logiciel","Chef de Projet":"Chef de Projet","Utilisateur":"Utilisateur"}']]
     },
     restoreButton:false,
     hideIdentifier: false,
     onSuccess:function(data, textStatus, jqXHR)
     {
      if(data.action == 'delete')
      {
       $('#'+data.id_utilisateur).remove();
      }
     }
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_utilisateur","#editable_table tbody tr")

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(1500).then(() => {
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'6'+')')
    }
});