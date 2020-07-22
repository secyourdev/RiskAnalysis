$(document).ready(function () {

    $('#importer_bdd_form').on('submit', function (event) {
        event.preventDefault();

        var fd = new FormData();
        var files = $('#import_bdd_file')[0].files[0];
        console.log(files);

        fd.append('userfile', files);
        console.log(fd);

        $.ajax({
            url: "content/php/import_bdd/import.php",
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
                $('#success_message').html("<div class='alert alert-success'>Base de données importée</div>");
                location.reload();
            }
        })

    });
});