$("#file_submit").click(function () {

    var fd = new FormData();
    var files = $('#fileToUpload')[0].files[0];
    fd.append('userfile', files);

    $.ajax({
        url: 'content/php/atelier1d/parser_regles.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
              console.log(data);
            // document.getElementById('ecrire_socle').innerHTML = data;
            $('#editable_table_socle tbody').append("<tr>"  + data + "</tr>");
            // document.getElementById('ecrire_socle').appendChild(data);

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
            location.reload();
        }
    })
});
