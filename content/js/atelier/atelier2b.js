var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;

/*--------------------------------- TABLES JS -------------------------------*/

$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'content/php/atelier2b/modification.php',
        deleteButton: false,
        columns: {
            identifier: [0, 'id_source_de_risque'],
            editable: [
                [1, 'type_d_attaquant_source_de_risque'],
                [2, 'profil_de_l_attaquant_source_de_risque'],
                [3, 'description_source_de_risque'], 
                [4, 'objectif_vise'],
                [5, 'description_objectif_vise'],
                [6, 'motivation', '{"..." : "...", "1": "1", "2": "2", "3": "3"}'],
                [7, 'ressources', '{"..." : "...", "1": "1", "2": "2", "3": "3"}'],
                [8, 'activite', '{"..." : "...", "1": "1", "2": "2", "3": "3"}'],
                [9, 'mode_operatoire'],
                [10, 'secteur_d_activite'],
                [11, 'arsenal_d_attaque'],
                [12, 'faits_d_armes'],
                [13, 'pertinence', '{"Auto" : "Auto", "Faible": "Faible", "Moyen": "Moyen", "Elevé": "Elevé"}'],
                [14, 'choix_source_de_risque', '{"..." : "...", "P1": "P1", "P2": "P2"}']
            ],
        },
        restoreButton: false,
        // onSuccess: function (data, textStatus, jqXHR) {
        //     if (data.action == 'delete') {
        //         $('#' + data.id_source_de_risque).remove();
        //     }
        // }
    });
});


/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_srov","#editable_table tbody tr")


/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'15'+')')
    }
});