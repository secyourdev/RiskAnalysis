var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;
var k=0;
var l=0;
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
      editable:[[1, "nom_valeur_metier"],[2, 'nature_valeur_metier'], [3, 'description_valeur_metier'], [4, 'id_personne']]
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
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'4'+')')
    }
});

sleep(100).then(() => {
    for(let i=editable_table.rows.length-1;i<editable_table.rows.length+tableau_vm.rows.length-2;i++){
        k++;
        button[i].setAttribute('onclick','tableau_verification('+k+','+'tableau_vm'+','+'5'+')')
    }
});

sleep(100).then(() => {
    for(let i=editable_table.rows.length+tableau_vm.rows.length-2;i<editable_table.rows.length+tableau_vm.rows.length+tableau_bs.rows.length-3;i++){
        l++;
        button[i].setAttribute('onclick','tableau_verification('+l+','+'tableau_bs'+','+'4'+')')
    }
});