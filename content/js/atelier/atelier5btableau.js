var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;

/*--------------------------------- TABLES JS -------------------------------*/

$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'content/php/atelier5btableau/modification.php',
        columns: {
            identifier: [0, 'id_mesure'],
            editable: [
            [12, 'dependance_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
            [13, 'penetration_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
            [14, 'maturite_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
            [15, 'confiance_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
            [20, 'nom_mesure_securite'],
            [21, 'description_mesure_securite']
        ]   
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
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'21'+')')
    }
});