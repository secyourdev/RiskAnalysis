// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable1').DataTable( {
        "paging":   false,
        "info":     false,
        "rowsGroup": [0]
    } );
    $('#dataTable2').DataTable( {
        "paging":   false,
        "info":     false,
        "rowsGroup":    [0,1,2,3,6]
    } );
    $('#dataTable3').DataTable( {
        "paging":   false,
        "info":     false
    } );
} );