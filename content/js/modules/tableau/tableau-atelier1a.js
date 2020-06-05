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
            { "data": "id_personne" },
            { "data": "nom" },
            { "data": "prenom" },
            { "data": "poste" }
        ]
    });
    $('#dataTable2').DataTable({
        "paging": false,
        "ordering": true,
        "info": false
    });
} ); 