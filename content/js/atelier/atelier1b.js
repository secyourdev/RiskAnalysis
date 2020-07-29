/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var biensupport = document.getElementById("biensupport");
var descriptionbs = document.getElementById("descriptionbs");
var label_biensupport = document.getElementById("biensupport").previousSibling.previousSibling

var valeurmetier = document.getElementById("nomvm");
var descriptionvm = document.getElementById("descriptionvm");
var label_valeurmetier = document.getElementById("nomvm").previousSibling.previousSibling

var nommission = document.getElementById("nommission");
var responsable = document.getElementById("responsable");
var responsablevm = document.getElementById("responsable_vm");
var responsablebs = document.getElementById("responsable_bs");
var label_mission = document.getElementById("nommission").previousSibling.previousSibling
var label_responsable = document.getElementById("responsable").previousSibling.previousSibling
var label_responsablevm = document.getElementById("responsable_vm").previousSibling.previousSibling
var label_responsablebs = document.getElementById("responsable_bs").previousSibling.previousSibling

var regex_nom_mission = /^[a-zA-Z0-9éèàêâùïüëç\s-./:,'"]{1,50}$/
var regex_nom = /^[a-zA-Z0-9éèàêâùïüëç\s-./:,'"]{1,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëç\s-.]{1,1000}$/

var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j = 0;
var k = 0;
var l = 0;

/*-------------------------------- SIDEBAR ----------------------------------*/
show_sub_content()
sidebarToggleTop.addEventListener('click', show_sub_content,false);
sidebarToggle.addEventListener('click',show_sub_content,false);
window.addEventListener('resize', show_sub_content, false);
function show_sub_content(){
    var Atelier1 = document.getElementById('Atelier1');
    if(!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(min-width: 768px)").matches)){
        Atelier1.classList.add('show')
    }
}
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function () {
    $('#tableau_bs').Tabledit({
        url: 'content/php/atelier1b/modificationbs.php',
        columns: {
            identifier: [0, "id_bien_support"],
            editable: [[1, 'nom_bien_support'], [2, 'description_bien_support']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_bien_support).remove();
            }
        }
    });
});
$(document).ready(function () {
    $('#tableau_vm').Tabledit({
        url: 'content/php/atelier1b/modificationvm.php',
        columns: {
            identifier: [0, "id_valeur_metier"],
            editable: [[1, 'nom_valeur_metier'], [2, 'nature_valeur_metier', '{"Information": "Information", "Processus": "Processus"}'], [3, 'description_valeur_metier']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_valeur_metier).remove();
            }
        }
    });
});
$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'content/php/atelier1b/modificationmission.php',
        columns: {
            identifier: [0, 'id_mission'],
            editable: [[1, 'nom_mission'], [2, "responsable"], [4, "nom_responsable_vm"], [6, "nom_responsable_bs"]]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_mission).remove();
            }
        }
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_mission", "#editable_table tbody tr")
setSortTable('tableau_vm');
OURJQUERYFN.setFilterTable("#rechercher_valeur_metier", "#tableau_vm tbody tr")
setSortTable('tableau_bs');
OURJQUERYFN.setFilterTable("#rechercher_bien_support", "#tableau_bs tbody tr")

/*------------------------------ LABELS CACHES ------------------------------*/
label_biensupport.style.display="none"
label_valeurmetier.style.display="none"
label_mission.style.display="none"
label_responsable.style.display="none"
label_responsablebs.style.display="none"
label_responsablevm.style.display="none"

/*----------------------- ENREGISTREMENT DES COOKIES ------------------------*/
biensupport.addEventListener('keyup',function(event){
    verify_input(biensupport.value,regex_nom,biensupport)
    activate_label(biensupport.value,label_biensupport)
}) 

descriptionbs.addEventListener('keyup',function(event){
    verify_textarea(descriptionbs.value,regex_description,descriptionbs)
})


valeurmetier.addEventListener('keyup',function(event){
    verify_input(valeurmetier.value,regex_nom,valeurmetier)
    activate_label(valeurmetier.value,label_valeurmetier)
}) 

descriptionvm.addEventListener('keyup',function(event){
    verify_textarea(descriptionvm.value,regex_description,descriptionvm)
})

nommission.addEventListener('keyup',function(event){
    verify_input(nommission.value,regex_nom_mission,nommission)
    activate_label(nommission.value,label_mission)
}) 

responsable.addEventListener('keyup',function(event){
    verify_input(responsable.value,regex_nom,responsable)
    activate_label(responsable.value,label_responsable)
}) 

responsablevm.addEventListener('keyup',function(event){
    verify_input(responsablevm.value,regex_nom,responsablevm)
    activate_label(responsablevm.value,label_responsablevm)
})

responsablebs.addEventListener('keyup',function(event){
    verify_input(responsablebs.value,regex_nom,responsablebs)
    activate_label(responsablebs.value,label_responsablebs)
})