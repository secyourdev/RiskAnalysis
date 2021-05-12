$('.custom-file-input').on('change', function () {
    var fileName_path = $(this).val()
    var fileName = fileName_path.substring(fileName_path.lastIndexOf('\\') + 1)
    
    $(this).next('.custom-file-label').addClass("selected").html(fileName)
})