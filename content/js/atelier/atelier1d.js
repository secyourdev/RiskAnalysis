/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var typereferentiel = document.getElementById("type_referenciel");
var nomreferentiel = document.getElementById("nom_referentiel");
var commentaire = document.getElementById("commentaire");

var label_typereferentiel = document.getElementById("type_referenciel").previousSibling.previousSibling
var label_nomreferentiel = document.getElementById("nom_referentiel").previousSibling.previousSibling
var label_commentaire = document.getElementById("commentaire").previousSibling.previousSibling

var id_regle = document.getElementById("id_regle");
var titre_regle = document.getElementById("titre_regle");
var description = document.getElementById("description");

var label_id_regle = document.getElementById("id_regle").previousSibling.previousSibling


var regex_nom = /^[a-zA-Z0-9éèàêâùïüëç\s-./:,'"]{1,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëç\s-.]{1,1000}$/
/*------------------------------- SIDEBAR ----------------------------------*/
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

$(document).ready(function () {
    $('#editable_table_socle').Tabledit({
        url: 'content/php/atelier1d/modification_socle.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_socle_securite'],
            editable: [
                // [1, 'type_referentiel'],
                // [2, 'nom_referentiel'],
                [3, 'etat_d_application', '{"Non appliqué" : "Non appliqué" , "Appliqué sans restriction" : "Appliqué sans restriction" , "Appliqué avec restriction" : "Appliqué avec restriction"}'],
                [4, 'etat_de_la_conformite']
            ],
            // checkboxeditable: [],
            dateeditable: []
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_socle_securite).remove();
            }
        }
    });
});
$(document).ready(function () {
    $('#editable_table_ecart').Tabledit({
        url: 'content/php/atelier1d/modification_regle.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_ecarts'],
            editable: [
                // [1, 'id_regle'],
                // [2, 'titre'],
                // [3, 'description'],
                [4, 'etat_de_la_regle', '{"Non traité" : "Non traité" , "Conforme" : "Conforme" , "Partiellement conforme" : "Partiellement conforme" ,  "Non conforme" : "Non conforme", "Non applicable" : "Non applicable"}'],
                [5, 'justification_ecart'],
                [6, 'nom'],
                // [7, 'date']
            ],
            
            dateeditable: [[7, 'date']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_ecarts).remove();
            }
        }
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table_socle');
OURJQUERYFN.setFilterTable("#rechercher_socle", "#editable_table_socle tbody tr")
/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table_ecart');
OURJQUERYFN.setFilterTable("#rechercher_ecart", "#editable_table_ecart tbody tr")

/*------------------------------ LABELS CACHES ------------------------------*/
label_typereferentiel.style.display="none"
label_nomreferentiel.style.display="none"
label_commentaire.style.display="none"
label_id_regle.style.display="none"

/*----------------------- ENREGISTREMENT DES COOKIES ------------------------*/
typereferentiel.addEventListener('keyup',function(event){
    verify_input(typereferentiel.value,regex_nom,typereferentiel)
    activate_label(typereferentiel.value,label_typereferentiel)
}) 

nomreferentiel.addEventListener('keyup',function(event){
    verify_input(nomreferentiel.value,regex_nom,nomreferentiel)
    activate_label(nomreferentiel.value,label_nomreferentiel)
}) 

commentaire.addEventListener('keyup',function(event){
    verify_input(commentaire.value,regex_nom,commentaire)
    activate_label(commentaire.value,label_commentaire)
}) 

id_regle.addEventListener('keyup',function(event){
    verify_input(id_regle.value,regex_nom,id_regle)
    activate_label(id_regle.value,label_id_regle)
}) 

titre_regle.addEventListener('keyup',function(event){
    verify_textarea(titre_regle.value,regex_description,titre_regle)
})

description.addEventListener('keyup',function(event){
    verify_textarea(description.value,regex_description,description)
})