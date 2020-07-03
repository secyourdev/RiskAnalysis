var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j = 0;
var k = 0;
var l = 0;
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function () {

    $('#tableau_bs').Tabledit({
        url: 'content/php/atelier1b/modificationbs.php',
        columns: {
            identifier: [0, "id_bien_support"],
            editable: [[1, 'nom_bien_support'], [2, 'description_bien_support']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_bien_support).remove();
            }
        }
    });
    $('#tableau_vm').Tabledit({
        url: 'content/php/atelier1b/modificationvm.php',
        columns: {
            identifier: [0, "id_valeur_metier"],
            editable: [[1, 'nom_valeur_metier'], [2, 'nature_valeur_metier', '{"Information": "Information", "Processus": "Processus"}'], [3, 'description_valeur_metier']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_valeur_metier).remove();
            }
        }
    });
    $('#editable_table').Tabledit({
        url: 'content/php/atelier1b/modificationmission.php',
        columns: {
            identifier: [0, 'id_mission'],
            editable: [[1, 'nom_mission'], [2, "respo_mis_nom"], [3, "respo_mis_prenom"], [4, "respo_mis_poste"], [5, 'nom_valeur_metier'], [6, 'respo_val_nom'], [7, 'nom_bien_support'], [8, 'respo_bien_nom']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_mission).remove();
            }
        }
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_mission", "#editable_table tbody tr")
setSortTable('tableau_vm');
OURJQUERYFN.setFilterTable("#rechercher_valeur_metier", "#tableau_vm tbody tr")
setSortTable('tableau_bs');
OURJQUERYFN.setFilterTable("#rechercher_bien_support", "#tableau_bs tbody tr")

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for (let i = 0; i < editable_table.rows.length - 1; i++) {
        j = i + 1;
        button[i].setAttribute('onclick', 'tableau_verification(' + j + ',' + 'editable_table' + ',' + '5' + ')')
    }
});

sleep(100).then(() => {
    for (let i = editable_table.rows.length - 1; i < editable_table.rows.length + tableau_vm.rows.length - 2; i++) {
        k++;
        button[i].setAttribute('onclick', 'tableau_verification(' + k + ',' + 'tableau_vm' + ',' + '8' + ')')
    }
});

sleep(100).then(() => {
    for (let i = editable_table.rows.length + tableau_vm.rows.length - 2; i < editable_table.rows.length + tableau_vm.rows.length + tableau_bs.rows.length - 3; i++) {
        l++;
        button[i].setAttribute('onclick', 'tableau_verification(' + l + ',' + 'tableau_bs' + ',' + '7' + ')')
    }
});
