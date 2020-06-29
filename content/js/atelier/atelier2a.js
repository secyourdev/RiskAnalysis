var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;

/*--------------------------------- TABLES JS -------------------------------*/

$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'content/php/atelier2a/modification.php',
        columns: {
            identifier: [0, 'id_source_de_risque'],
            editable: [
                [1, 'type_d_attaquant_source_de_risque'],
                [2, 'profil_de_l_attaquant_source_de_risque'],
                [3, 'description_source_de_risque'], 
                [4, 'objectif_vise'],
                [5, 'description_objectif_vise']
            ],
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_source_de_risque).remove();
            }
        }
    });
});


/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_srov","#editable_table tbody tr")


/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'6'+')')
    }
});