$('#radio_gravite5').click(function () {
    $.ajax({
        url: 'content/php/atelier1a/gravite.php',
        type: 'POST',
        data: {
            radio_gravite: $('#radio_gravite5').val()
        },
    });
});
$('#radio_gravite4').click(function () {
    $.ajax({
        url: 'content/php/atelier1a/gravite.php',
        type: 'POST',
        data: {
            radio_gravite: $('#radio_gravite4').val()
        },
    });
});