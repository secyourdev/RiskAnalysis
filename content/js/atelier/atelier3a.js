var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;



$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'content/php/atelier3a/modification.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_partie_prenante'],
            editable: [
                [1, 'categorie_partie_prenante'],
                [2, 'nom_partie_prenante'],
                [3, 'type', '{"Interne": "Interne", "Externe":"Externe" }'],
                
                [4, 'dependance_partie_prenante', '{ "1": "1", "2": "2", "3": "3", "4": "4" }'],
                [5, 'ponderation_dependance'],
                
                [6, 'penetration_partie_prenante', '{ "1": "1", "2": "2", "3": "3", "4": "4" }'],
                [7, 'ponderation_penetration'],
                
                [8, 'maturite_partie_prenante', '{ "1": "1", "2": "2", "3": "3", "4": "4" }'],
                [9, 'ponderation_maturite'],
                
                [10, 'confiance_partie_prenante', '{ "1": "1", "2": "2", "3": "3", "4": "4" }'],
                [11, 'ponderation_confiance']
                
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
OURJQUERYFN.setFilterTable("#rechercher_evenement_redoute","#editable_table tbody tr")


/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
// sleep(100).then(() => {
//     for(let i=0;i<editable_table.rows.length-1;i++){
//         j=i+1;
//         button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'15'+')')
//     }
// });



function get_database_seuil() {
    $.ajax({
        url: 'content/php/atelier3a/selection_seuil.php',
        type: 'POST',
        dataType: 'html',
        success: function (resultat) {
            console.log(resultat);
            
            var seuil = JSON.parse(resultat);
            sessionIdProjet = sessionIdProjet - 1
            console.log(sessionIdProjet);
            seuil_danger.value = seuil[sessionIdProjet][1]
            seuil_controle.value = seuil[sessionIdProjet][2]
            seuil_veille.value = seuil[sessionIdProjet][3]

        },
        error: function (erreur) {
            alert('ERROR :' + erreur);
        }
    });
}
get_database_seuil()