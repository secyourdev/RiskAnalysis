/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var categorie = document.getElementById("categorie_partie_prenante");
var nom = document.getElementById("nom_partie_prenante");
var label_categorie = document.getElementById("categorie_partie_prenante").previousSibling.previousSibling
var label_nom = document.getElementById("nom_partie_prenante").previousSibling.previousSibling

var regex_nom = /^[a-zA-Z0-9éèàêâùïüëç\s-.:,'"]{0,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëç\s-.:,'"]{0,1000}$/

/*------------------------------- SIDEBAR ----------------------------------*/
show_sub_content()
sidebarToggleTop.addEventListener('click', show_sub_content,false);
sidebarToggle.addEventListener('click',show_sub_content,false);
window.addEventListener('resize', show_sub_content, false);
function show_sub_content(){
    var Atelier1 = document.getElementById('Atelier3');
    if(!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(min-width: 768px)").matches)){
        Atelier1.classList.add('show')
    }
}
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'content/php/atelier3a/modification.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_partie_prenante'],
            editable: [
                [1, 'categorie_partie_prenante'],
                [2, 'nom_partie_prenante'],
                [3, 'type', '{"Interne": "Interne", "Externe":"Externe" }'],
                
                [4, 'dependance_partie_prenante', '{ "1": "1", "2": "2", "3": "3", "4": "4" }'],
                [5, 'ponderation_dependance'],
                
                [6, 'penetration_partie_prenante', '{ "1": "1", "2": "2", "3": "3", "4": "4" }'],
                [7, 'ponderation_penetration'],
                
                [8, 'maturite_partie_prenante', '{ "1": "1", "2": "2", "3": "3", "4": "4" }'],
                [9, 'ponderation_maturite'],
                
                [10, 'confiance_partie_prenante', '{ "1": "1", "2": "2", "3": "3", "4": "4" }'],
                [11, 'ponderation_confiance'],
                [13, 'criticite', '{"Peu critique" : "Peu critique", "Moyennement critique" : "Moyennement critique", "Très critique" : "Très critique"}']
                
            ]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_evenement_redoutes).remove();
            }
        }
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_evenement_redoute","#editable_table tbody tr")
/*-------------------------------- FONCTIONS --------------------------------*/
function get_database_seuil() {
    $.ajax({
        url: 'content/php/atelier3a/selection_seuil.php',
        type: 'POST',
        dataType: 'html',
        success: function (resultat) {
            // console.log(resultat);
            
            var seuil = JSON.parse(resultat);
            console.log('seuil');
            
            console.log(seuil);
            
            seuil_danger.value = seuil[0]["seuil_danger"]
            seuil_controle.value = seuil[0]["seuil_controle"]
            seuil_veille.value = seuil[0]["seuil_veille"]

        },
        error: function (erreur) {
            alert('ERROR :' + erreur);
        }
    });
}
get_database_seuil()

/*------------------------------ LABELS CACHES ------------------------------*/
label_nom.style.display="none"
label_categorie.style.display="none"

/*------------------------- VERIFICATION DES CHAMPS -------------------------*/
categorie.addEventListener('keyup',function(event){
    verify_input(categorie.value,regex_nom,categorie)
    activate_label(categorie.value,label_categorie)
}) 

nom.addEventListener('keyup',function(event){
    verify_input(nom.value,regex_nom,nom)
    activate_label(nom.value,label_nom)
}) 
