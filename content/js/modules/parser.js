$(document).ready(function () {

    $("#file_submit").click(function () {

        var fd = new FormData();
        var files = $('#fileToUpload')[0].files[0];
        fd.append('fileToUpload', files);

        $.ajax({
            url: 'content/php/atelier1c/parser_regles.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != 0) {
                    // $("#img").attr("src", response);
                    // $(".preview img").show(); // Display image element
                } else {
                    alert('file not uploaded');
                }
            },
        });
    });
});