// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable( {
        "paging":   false,
        "ordering": true,
        "info":     false,
        "processing": true,
        "serverSide": true,
        "ajax": "content/js/modules/tableau/scripts/test2.php",
        "columns": [
            { "data": "nom" },
            { "data": "prenom" },
            { "data": "poste" }
        ]
    } );
} ); 