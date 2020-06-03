// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable1').DataTable( {
        "paging":   false,
        "info":     false,
        "ordering": false
    } );
    $('#dataTable2').DataTable( {
        "paging":   false,
        "info":     false,
        "ordering": false
    } );
} );