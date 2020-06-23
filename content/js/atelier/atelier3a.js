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
                [5, 'penetration_partie_prenante', '{ "1": "1", "2": "2", "3": "3", "4": "4" }'],
                [6, 'maturite_partie_prenante', '{ "1": "1", "2": "2", "3": "3", "4": "4" }'],
                [7, 'confiance_partie_prenante', '{ "1": "1", "2": "2", "3": "3", "4": "4" }']
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
