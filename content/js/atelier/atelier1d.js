$(document).ready(function () {
    $('#editable_table_socle').Tabledit({
        url: 'content/php/atelier1d/modification_socle.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_socle_securite'],
            editable: [
                // [1, 'type_referentiel'],
                // [2, 'nom_referentiel'],
                [3, 'etat_d_application'],
                [4, 'etat_de_la_conformite']
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
    $('#editable_table_ecart').Tabledit({
        url: 'content/php/atelier1d/modification_ecart.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_ecarts'],
            editable: [
                // [1, 'titre'],
                [2, 'etat_de_la_regle'],
                [3, 'justification_ecart'],
                [4, 'nom'],
                [5, 'date']
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
