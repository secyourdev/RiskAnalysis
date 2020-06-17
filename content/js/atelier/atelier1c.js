var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;


/*--------------------------------- TABLES JS -------------------------------*/

$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'content/php/atelier1c/modification.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_evenement_redoutes'],
            editable: [
                [2, 'nom_evenement_redoutes'],
                [3, 'description_evenement_redoutes'],
                [4, 'impact'], 
                [9, 'niveau_de_gravite']
            ],
            checkboxeditable: [
               [5, 'confidentialite'],
               [6, 'integrite'],
               [7, 'disponibilite'],
               [8, 'tracabilite']
           ]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_evenement_redoutes).remove();
            }
        }
    });
});


/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#editable_table","#tableau_mission tbody tr")


/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'10'+')')
    }
});