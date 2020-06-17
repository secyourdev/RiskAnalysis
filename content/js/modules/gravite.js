$('#radio_gravite5').click(function () {
    $.ajax({
        url: 'content/php/atelier1c/gravite.php',
        type: 'POST',
        data: {
            radio_gravite: $('#radio_gravite5').val()
        },
/*         success: function (msg) {
            alert('gravite5 sent');
        } */
    });
});
$('#radio_gravite4').click(function () {
    $.ajax({
        url: 'content/php/atelier1c/gravite.php',
        type: 'POST',
        data: {
            radio_gravite: $('#radio_gravite4').val()
        },
/*         success: function (msg) {
            alert('gravite4 sent');
        } */
    });
});