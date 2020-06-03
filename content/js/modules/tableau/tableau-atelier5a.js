// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable( {
        "paging":   false,
        "info":     false,
        "ordering": false
    } );
} );