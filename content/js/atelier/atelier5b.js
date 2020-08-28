/*------------------------------ VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var nom_mesure = document.getElementById('nommesure')
var description_mesure = document.getElementById('descriptionmesure')

var label_nom = document.getElementById('nommesure').previousSibling.previousSibling
var label_description = document.getElementById('descriptionmesure').previousSibling.previousSibling

var regex_nom = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{0,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{0,100}$/
/*------------------------------- SIDEBAR ----------------------------------*/
show_sub_content()
sidebarToggleTop.addEventListener('click', show_sub_content,false);
sidebarToggle.addEventListener('click',show_sub_content,false);
window.addEventListener('resize', show_sub_content, false);
function show_sub_content(){
    var Atelier5 = document.getElementById('Atelier5');
    if(!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(min-width: 768px)").matches)){
        Atelier5.classList.add('show')
    }
}
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function () {

    $('#editable_table').Tabledit({
        url: 'content/php/atelier5b/modificationpacs.php',
        columns: {
            identifier: [0, 'id_traitement_de_securite'],
            editable: [
                // [1, "nom_mesure"],
                // [2, "description_mesure"],
                // [3, "id_risque"],
                [4, 'principe_de_securite', '{"Gouvernance" : "Gouvernance", "Protection" : "Protection", "Defense" : "Defense", "Resilience" : "Resilience"}'],
                [5, "responsable"],
                [6, "difficulte_traitement_de_securite"],
                [8, "cout_traitement_de_securite", '{"+" : "+", "++" : "++", "+++" : "+++"}'],
                [9, "statut", '{"A lancer" : "A lancer", "En cours" : "En cours", "Terminé" : "Terminé"}']],
            dateeditable: [[7, 'date_traitement_de_securite']]

        },
        restoreButton: false,
        deleteButton: false

    });
});
/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_pacs","#editable_table tbody tr")
/*--------------------------- Couleurs pacs > statut --------------------------*/
$("#editable_table > tbody > tr > td:nth-child(10)").each(function () {
    if ($(this)[0].innerText == "Terminé") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "En cours") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "A lancer") { $(this)[0].classList.add('fond-rouge'); }

});
/*------------------------------ LABELS CACHES ------------------------------*/
label_nom.style.display="none"
/*-------------------------- VERIFICATION DES CHAMPS ------------------------*/
nom_mesure.addEventListener('keyup',function(event){
    verify_input(nom_mesure.value,regex_nom,nom_mesure)
    activate_label(nom_mesure.value,label_nom)
}) 

description_mesure.addEventListener('keyup',function(event){
    verify_textarea(description_mesure.value,regex_description,description_mesure)
})
/*----------------------------- EXPORT EXCEL --------------------------------*/
export_table_to_excel('editable_table','#button_download_PACS','PACS.xlsx')