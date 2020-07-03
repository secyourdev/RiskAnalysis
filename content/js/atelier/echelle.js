var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;
var k=0;
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function(){  
    
    $('#editable_table').Tabledit({
     url:'content/php/atelier1b/modification.php',
     columns:{
      identifier:[0, 'id_echelle'],
      editable:[[1, 'nom_echelle'], [2, "echelle_gravite", '{"4" : "4", "5" : "5"}'], [3, "echelle_vraisemblance", '{"4" : "4", "5" : "5"}']]
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
    $('#tableau_niveau').Tabledit({
        deleteButton: false,
     url:'content/php/echelle/modificationniveau.php',
     columns:{
      identifier:[0, "id_niveau"],
      editable:[[2, 'description_niveau']]
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
    
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_echelle","#editable_table tbody tr")
setSortTable('tableau_niveau');
OURJQUERYFN.setFilterTable("#rechercher_niveau","#tableau_niveau tbody tr")

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'4'+')')
    }
});

sleep(100).then(() => {
    for(let i=editable_table.rows.length-1;i<editable_table.rows.length+tableau_niveau.rows.length-2;i++){
        k++;
        button[i].setAttribute('onclick','tableau_verification('+k+','+'tableau_niveau'+','+'3'+')')
    }
});



