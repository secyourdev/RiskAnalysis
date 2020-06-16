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
                $('#' + data.id_personne).remove();
            }
        }
    });
});
