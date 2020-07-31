$(document).ready(function () {

    $('#sample_form').on('submit', function (event) {
        event.preventDefault();

        var fd = new FormData();
        var files = $('#fileToUpload')[0].files[0];

        fd.append('userfile', files);

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

                sleep(2000).then(() => {
                    location.reload();
                });
            }
        })

    });



});