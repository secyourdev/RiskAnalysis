$(document).ready(function () {
    $('#editable_table_socle').Tabledit({
        url: 'content/php/atelier1d/modification_socle.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_socle_securite'],
            editable: [
                // [1, 'type_referentiel'],
                // [2, 'nom_referentiel'],
                [3, 'etat_d_application', '{"Non appliqué" : "Non appliqué" , "Appliqué sans restriction" : "Appliqué sans restriction" , "Appliqué avec restriction" : "Appliqué avec restriction"}'],
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
                // [1, 'id_regle'],
                // [2, 'titre'],
                [3, 'etat_de_la_regle', '{"Non traité" : "Non traité" , "Conforme" : "Conforme" , "Partiellement conforme" : "Partiellement conforme" ,  "Non conforme" : "Non conforme", "Non applicable" : "Non applicable"}'],
                [4, 'justification_ecart'],
                [5, 'nom'],
                [6, 'date']
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
setSortTable('editable_table_socle');
OURJQUERYFN.setFilterTable("#rechercher_socle", "#editable_table_socle tbody tr")
/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table_ecart');
OURJQUERYFN.setFilterTable("#rechercher_ecart", "#editable_table_ecart tbody tr")