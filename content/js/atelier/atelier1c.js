var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;
var k=0;
var l=0;

/*--------------------------------- TABLES JS -------------------------------*/

$(document).ready(function(){  
    $('#editable_table').Tabledit({
     url:'content/php/echelle/modificationechelle.php',
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
    })
    $(document).ready(function () {
        var json_gravite = "";
        var gravite ="";
        $.ajax({
            url: 'content/php/atelier1c/gravite_choisie.php',
            type: 'POST',
            success: function (data) {
                // console.log(data);
                gravite = data;
                console.log(gravite);
                if (gravite == 4) {
                    json_gravite = '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}';
                }
                else {
                    json_gravite = '{"1" : "1", "2" : "2", "3" : "3", "4" : "4", "5" : "5"}';
                }
                console.log(json_gravite);
                $('#tableau_er').Tabledit({
                    url: 'content/php/atelier1c/modification.php',
                    sortable: true,
                    columns: {
                        identifier: [0, 'id_evenement_redoute'],
                        editable: [
                            [1, 'nom_valeur_metier'],
                            [2, 'nom_evenement_redoute'],
                            [3, 'description_evenement_redoute'],
                            [4, 'impact'], 
                            [5, 'confidentialite', '{"1" : "1", "2" : "2", "3" : "3"}'],
                            [6, 'integrite', '{"1" : "1", "2" : "2", "3" : "3"}'],
                            [7, 'disponibilite', '{"1" : "1", "2" : "2", "3" : "3"}'],
                            [8, 'tracabilite', '{"1" : "1", "2" : "2", "3" : "3"}'],
                            [9, 'niveau_de_gravite', json_gravite]
                        ],
                    },
                    restoreButton: false,
                    onSuccess: function (data, textStatus, jqXHR) {
                        if (data.action == 'delete') {
                            $('#' + data.id_evenement_redoutes).remove();
                        }
                    }
                });
            }
        }) 
        // console.log(gravite);  
        // $('#tableau_er').Tabledit({
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
    });
});


/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_echelle","#editable_table tbody tr")
setSortTable('tableau_niveau');
OURJQUERYFN.setFilterTable("#rechercher_niveau","#tableau_niveau tbody tr")
setSortTable('tableau_er');
OURJQUERYFN.setFilterTable("#rechercher_er","#tableau_er tbody tr")


/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'3'+')')
    }
});

sleep(100).then(() => {
    for(let i=editable_table.rows.length-1;i<editable_table.rows.length+tableau_niveau.rows.length-2;i++){
        k++;
        button[i].setAttribute('onclick','tableau_verification('+k+','+'tableau_niveau'+','+'3'+')')
    }
});

sleep(100).then(() => {
    for(let i=editable_table.rows.length+tableau_niveau.rows.length-2;i<editable_table.rows.length+tableau_niveau.rows.length+tableau_niveau.rows.length-3;i++){
        k++;
        button[i].setAttribute('onclick','tableau_verification('+l+','+'tableau_niveau'+','+'10'+')')
    }
});