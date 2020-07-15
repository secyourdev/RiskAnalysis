var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;
var k=0;
var l=0;
var valeurs = {};
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function(){  
    $.ajax({
        url: 'content/php/atelier4b/vraisemblance.php',
        type: 'POST',
        success: function (data){
            console.log(data);
            if (data == 4){
                valeurs = '{"1" : "1 (Invraisemblable)", "2" : "2 (Peu vraisemblable)", "3" : "3 (Vraisemblable)", "4" : "4 (Très vraisemblable)"}';
            }
            else {
                valeurs = '{"1" : "1 (Invraisemblable)", "2" : "2 (Peu vraisemblable)", "3" : "3 (Vraisemblable)", "4" : "4 (Très vraisemblable)", "5" : "5 (Quasi certain)"}';
            }
            console.log(valeurs);
            $('#editable_table').Tabledit({
                url:'content/php/atelier4b/modification.php',
             columns:{
              identifier:[0, 'id_scenario_operationnel'],
              editable:[[4, "vraisemblance", valeurs]]
             },
             restoreButton:false,
             deleteButton: false
            
            });

            /*--------------------------- SORT & FILTER TABLES --------------------------*/
            setSortTable('editable_table');
            OURJQUERYFN.setFilterTable("#rechercher_chemin","#editable_table tbody tr")

            /*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
            sleep(100).then(() => {
                for(let i=0;i<editable_table.rows.length-1;i++){
                    j=i+1;
                    button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'5'+')')
                }
            });

        }
        
    })
    
});

// /*--------------------------- SORT & FILTER TABLES --------------------------*/
// setSortTable('editable_table');
// OURJQUERYFN.setFilterTable("#rechercher_chemin","#editable_table tbody tr")

// /*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
// sleep(100).then(() => {
//     for(let i=0;i<editable_table.rows.length-1;i++){
//         j=i+1;
//         button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'5'+')')
//     }
// });


