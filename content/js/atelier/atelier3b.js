$(document).ready(function () {
    $('#editable_table_evenement_redoutes').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_evenement_redoutes'],
            editable: [],
            checkboxeditable: [
                [5, 'confidentialite'],
                [6, 'integrite'],
                [7, 'disponibilite'],
                [8, 'tracabilite']
            ]
        },
        eventType: 'none',
        restoreButton: false,
        editButton: false,
        deleteButton: false,
    });
});
$(document).ready(function () {
    $('#editable_table_SROV').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_source_de_risque'],
            editable: [],
            checkboxeditable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false,
    });
});
$(document).ready(function () {
    $('#editable_table_scenario_strategique').Tabledit({
        url: 'content/php/atelier3b/modification_scenario.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_scenario_strategique'],
            editable: [
                [1, 'nom_scenario_strategique'],
                [2, 'id_evenement_redoute'],
                [3, 'id_partie_prenante'],
                [4, 'id_source_de_risque']
            ],
            checkboxeditable: []
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_evenement_redoutes).remove();
            }
        }
    });
});
$(document).ready(function () {
    $('#editable_table_chemin_d_attaque').Tabledit({
        url: 'content/php/atelier3b/modification_chemin.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_chemin_d_attaque_strategique'],
            editable: [
                [2, 'chemin_d_attaque_strategique'],
                [3, 'dependance_residuelle'],
                [4, 'penetration_residuelle'],
                [5, 'maturite_residuelle'],
                [6, 'confiance_residuelle'],
                [7, 'niveau_de_menance_residuelle'],
            ],
            checkboxeditable: []
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_evenement_redoutes).remove();
            }
        }
    });
});
