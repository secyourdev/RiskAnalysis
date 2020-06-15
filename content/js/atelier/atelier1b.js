var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')



/*--------------------------------- TABLES JS -------------------------------*/

$(document).ready(function(){  
    $('#editable_table').Tabledit({
     url:'content/php/atelier1b/modificationmission.php',
     columns:{
      identifier:[0, 'id_mission'],
      editable:[[1, 'nom_mission'], [2, "nom"], [3, "poste"]]
     },
     restoreButton:false,
     onSuccess:function(data, textStatus, jqXHR)
     {
      if(data.action == 'delete')
      {
       $('#'+data.id_mission).remove();
      }
     }
    });
    $('#tableau_vm').Tabledit({
     url:'content/php/atelier1b/modificationvm.php',
     columns:{
      identifier:[0, "id_valeur_metier"],
      editable:[[1, 'nom_valeur_metier'], [2, 'nature_valeur_metier'], [3, 'description_valeur_metier'], [4, 'nom']]
     },
     restoreButton:false,
     onSuccess:function(data, textStatus, jqXHR)
     {
      if(data.action == 'delete')
      {
       $('#'+data.id_valeur_metier).remove();
      }
     }
    });
    $('#tableau_bs').Tabledit({
     url:'content/php/atelier1b/modificationbs.php',
     columns:{
      identifier:[0, "id_personne"],
      editable:[[1, 'nom'], [2, 'prenom'], [3, 'poste']]
     },
     restoreButton:false,
     onSuccess:function(data, textStatus, jqXHR)
     {
      if(data.action == 'delete')
      {
       $('#'+data.id_personne).remove();
      }
     }
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/

setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#editable_table","#tableau_mission tbody tr")
setSortTable('tableau_vm');
OURJQUERYFN.setFilterTable("#rechercher_valeur_metier","#tableau_vm tbody tr")
setSortTable('tableau_bs');
OURJQUERYFN.setFilterTable("#rechercher_bien_support","#tableau_bs tbody tr")

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<button.length;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+')')
    }
});