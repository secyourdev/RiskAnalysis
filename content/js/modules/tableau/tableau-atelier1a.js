// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable({
        "paging": false,
        "ordering": true,
        "info": false
    });
    $('#dataTable2').DataTable({
        "paging": false,
        "ordering": true,
        "info": false
    });
} ); 