$('.custom-file-input').on('change', function () {
    var fileName_path = $(this).val()

    console.log(fileName_path)
    var fileName = fileName_path.substring(fileName_path.lastIndexOf('\\') + 1)
    console.log(fileName)
    $(this).next('.custom-file-label').addClass("selected").html(fileName)
})