
const select_scenar = document.getElementById('nom_scenario_strategique');

select_scenar.addEventListener('change', (event) => {
    //   const result = document.querySelector('.result');
    //   console.log(`Valeur  ${select_scenar.value}`);
    $.ajax({
        url: 'content/php/atelier3b/affichage_image.php',
        type: 'POST',
        data: {
            id_scenario: select_scenar.value
        },
        success: function (data) {
              console.log("je suis le ajax");
            // document.getElementById('ecrire_ecart').innerHTML = data;
            // $('#editable_table_ecart tbody').append(data);
            
            
            const inpFile = document.getElementById("inpFile");
            const previewContainer = document.getElementById("imagePreview");
            const previewImage = previewContainer.querySelector(".image-preview__image");
            const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

            previewDefaultText.style.display = "none";
            previewImage.style.display = "block";
            previewContainer.style.border = "none";

            previewImage.setAttribute("src", 'image/' + data);

            // if (data.length()>0) {
            //     // const reader = new FileReader();

            //     previewDefaultText.style.display = "none";
            //     previewImage.style.display = "block";
            //     previewContainer.style.border = "none";

            //     // reader.addEventListener("load", function () {
            //     //     console.log(this);
            //         previewImage.setAttribute("src", 'image/' + data);
            //     // });

            //     // reader.readAsDataURL(file);
            // } else {
            //     previewDefaultText.style.display = null;
            //     previewImage.style.display = null;
            //     previewContainer.style.border = null;
            //     previewImage.setAttribute("src", "");
            // }
        }
    })


});