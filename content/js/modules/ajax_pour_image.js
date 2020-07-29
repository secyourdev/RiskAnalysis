if (document.getElementById('select_nom_scenario_strategique')!=null){
    const select_nom_scenario_strategique = document.getElementById('select_nom_scenario_strategique');
    $url = 'content/php/atelier3b/affichage_image.php';

    select_nom_scenario_strategique.selectedIndex = sessionStorage.getItem('select_nom_scenario_strategique')
    selectScenario(select_nom_scenario_strategique.value);

    select_nom_scenario_strategique.addEventListener('change', (event) => {
        sessionStorage.setItem('select_nom_scenario_strategique',select_nom_scenario_strategique.selectedIndex);
        selectScenario(select_nom_scenario_strategique.value);
    });
}
if (document.getElementById('select_nom_scenario_operationnel')!=null){
    const select_nom_scenario_operationnel = document.getElementById('select_nom_scenario_operationnel');
    $url = 'content/php/atelier4a/affichage_image.php';

    select_nom_scenario_operationnel.selectedIndex = sessionStorage.getItem('select_nom_scenario_operationnel')
    selectScenario(select_nom_scenario_operationnel.value);

    select_nom_scenario_operationnel.addEventListener('change', (event) => {
        sessionStorage.setItem('select_nom_scenario_operationnel',select_nom_scenario_operationnel.selectedIndex);
        selectScenario(select_nom_scenario_operationnel.value);
    });
}


function selectScenario(selected_value){   
    $.ajax({
        url: $url,
        type: 'POST',
        data: {
            id_scenario: selected_value
        },
        success: function (data) {
            if (data != "") {
                const inpFile = document.getElementById("inpFile");
                const previewContainer = document.getElementById("imagePreview");
                const previewImage = previewContainer.querySelector(".image-preview__image");
                const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

                previewDefaultText.style.display = "none";
                previewImage.style.display = "block";
                previewContainer.style.border = "none";
                previewImage.setAttribute("src", 'image/' + data);

            } else {
                console.log("nope");
                previewDefaultText.style.display = null;
                previewImage.style.display = null;
                previewContainer.style.border = null;
                previewImage.setAttribute("src", "");

            }
        }
    })
}