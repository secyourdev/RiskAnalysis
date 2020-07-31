/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var profilattaquant = document.getElementById("profil_attaquant");
var descriptionsr = document.getElementById("description_sr");
var objectifvise = document.getElementById("objectif_vise");
var descriptionov = document.getElementById("description_objectif_vise");

var label_profilattaquant = document.getElementById("profil_attaquant").previousSibling.previousSibling
var label_objectifvise = document.getElementById("objectif_vise").previousSibling.previousSibling


var regex_nom = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{0,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{0,100}$/

/*------------------------------- SIDEBAR ----------------------------------*/
show_sub_content()
sidebarToggleTop.addEventListener('click', show_sub_content,false);
sidebarToggle.addEventListener('click',show_sub_content,false);
window.addEventListener('resize', show_sub_content, false);
function show_sub_content(){
    var Atelier1 = document.getElementById('Atelier2');
    if(!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(min-width: 768px)").matches)){
        Atelier1.classList.add('show')
    }
}

/*--------------------------------- TABLES JS -------------------------------*/

$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'content/php/atelier2a/modification.php',
        columns: {
            identifier: [0, 'id_source_de_risque'],
            editable: [
                [1, 'type_d_attaquant_source_de_risque', '{"Organisation structurée" : "Organisation structurée", "Organisation idéologique" : "Organisation idéologique", "Individu isolé" : "Individu isolé"}'],
                [2, 'profil_de_l_attaquant_source_de_risque'],
                [3, 'description_source_de_risque'], 
                [4, 'objectif_vise'],
                [5, 'description_objectif_vise']
            ],
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_source_de_risque).remove();
            }
        }
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_srov","#editable_table tbody tr")

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'6'+')')
    }
});

/*------------------------------ LABELS CACHES ------------------------------*/
label_profilattaquant.style.display="none"
label_objectifvise.style.display="none"

/*----------------------- -- VERIFICATION DES CHAMPS -- ------------------------*/
profilattaquant.addEventListener('keyup',function(event){
    verify_input(profilattaquant.value,regex_nom,profilattaquant)
    activate_label(profilattaquant.value,label_profilattaquant)
}) 

objectifvise.addEventListener('keyup',function(event){
    verify_input(objectifvise.value,regex_nom,objectifvise)
    activate_label(objectifvise.value,label_objectifvise)
})

descriptionsr.addEventListener('keyup',function(event){
    verify_textarea(descriptionsr.value,regex_description,descriptionsr)
})

descriptionov.addEventListener('keyup',function(event){
    verify_textarea(descriptionov.value,regex_description,descriptionov)
})
