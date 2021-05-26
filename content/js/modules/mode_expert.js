$(document).ready(function () {
    $('#editable_table').Tabledit({
        columns: {
            identifier: [0, 'id_mesure'],
            editable: [],        
            dateeditable: [] 
        },
        restoreButton: false,
        editButton : false,
        deleteButton : false
    });
});
