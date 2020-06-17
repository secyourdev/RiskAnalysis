$(document).ready(function () {
    $('#editable_table_socle').Tabledit({
        url: 'content/php/atelier1d/modification.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_socle_securite'],
            editable: [
                [2, 'type_referentiel'],
                [3, 'nom_referentiel'],
                [4, 'etat_d_application'],
                [9, 'etat_de_la_conformite']
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
$(document).ready(function () {
    $('#editable_table_ecart').Tabledit({
        url: 'content/php/atelier1d/modification.php',
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
