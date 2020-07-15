$(document).ready(function () {

    $('#sample_form').on('submit', function (event) {
        event.preventDefault();

        var fd = new FormData();
        var files = $('#fileToUpload')[0].files[0];
        console.log(files);

        fd.append('userfile', files);
        console.log(fd);

        $.ajax({
            url: "content/php/atelier1d/parser_regles.php",
            method: "POST",
            data: fd,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#file_submit').attr('disabled', 'disabled');
                $('#ajax-loader').css('display', 'block');
            },
            success: function (data) {
                $('#ajax-loader').css('display', 'none');
                $('#file_submit').attr('disabled', false);
                $('#success_message').html("<div class='alert alert-success'>Fichier uploadé</div>");

                console.log('bonjour');
                sleep(2000).then(() => {
                    location.reload();
                });
            //     console.log(data);
            //     $('#editable_table_socle tbody').append(data);

            //     $(document).ready(function () {
            //         $('#editable_table_socle').Tabledit({
            //             url: 'content/php/atelier1d/modification_socle.php',
            //             sortable: true,
            //             columns: {
            //                 identifier: [0, 'id_socle_securite'],
            //                 editable: [
            //                     // [1, 'type_referentiel'],
            //                     // [2, 'nom_referentiel'],
            //                     [3, 'etat_d_application', '{"Non appliqué" : "Non appliqué" , "Appliqué sans restriction" : "Appliqué sans restriction" , "Appliqué avec restriction" : "Appliqué avec restriction"}'],
            //                     [4, 'etat_de_la_conformite']
            //                 ],
            //                 dateeditable: []
            //             },
            //             restoreButton: false,
            //             onSuccess: function (data, textStatus, jqXHR) {
            //                 if (data.action == 'delete') {
            //                     $('#' + data.id_evenement_redoutes).remove();
            //                 }
            //             }
            //         });
            //     });
            // // location.reload();
            }
        })

    });



});