$('.custom-file-input').on('change', function () {
    var fileName_path = $(this).val()
    var fileName = fileName_path.substring(fileName_path.lastIndexOf('\\') + 1)
    
    $(this).next('.custom-file-label').addClass("selected").html(fileName)
})


const inpFile = document.getElementById("inpFile");
const previewContainer = document.getElementById("imagePreview");
const previewImage = previewContainer.querySelector(".image-preview__image");
const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

inpFile.addEventListener("change", function () {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        previewDefaultText.style.display = "none";
        previewImage.style.display = "block";
        previewContainer.style.border = "none";

        reader.addEventListener("load", function () {
            previewImage.setAttribute("src", this.result);
        });
        
        reader.readAsDataURL(file);
    }else{
        previewDefaultText.style.display = null;
        previewImage.style.display = null;
        previewContainer.style.border = null;
        previewImage.setAttribute("src","");
    }

})