$('#id_socle_securite').on('change', 'select[data-child]', function () {
    $.ajax({
        url: 'content/php/atelier1c/ajout_ecart.php',
        type: 'POST',
        data: {
            id_socle_securite: $('#socle_securite').val()
        },
        success: function (msg) {
            alert('gravite5 sent');
        }
    });
});