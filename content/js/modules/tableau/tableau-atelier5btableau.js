// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable( {
        "paging":   false,
        "info":     false,
        "rowsGroup":    [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,16]
    } );
} );