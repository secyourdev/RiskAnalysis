/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var nomechelle = document.getElementById("nom_echelle");
var label_echelle = document.getElementById("nom_echelle").previousSibling.previousSibling

var nom_er = document.getElementById("nom_evenement_redoute");
var description_er = document.getElementById("description_evenement_redoute")
var impact = document.getElementById("impact");
var label_er = document.getElementById("nom_evenement_redoute").previousSibling.previousSibling

var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')

var regex_nom = /^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,1000}$/

var j=0;
var k=0;
var l=0;
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
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function(){  
    $('#editable_table').Tabledit({
     url:'content/php/echelle/modificationechelle.php',
     columns:{
      identifier:[0, 'id_echelle'],
      editable:[[1, 'nom_echelle'], [2, "echelle_gravite", '{"4" : "4", "5" : "5"}'], [3, "echelle_vraisemblance", '{"4" : "4", "5" : "5"}']]
     },
     restoreButton:false,
     onSuccess:function(data, textStatus, jqXHR)
     {
      if(data.action == 'delete')
      {
       $('#'+data.id_mission).remove();
      }
     }
    });
});
$(document).ready(function () {
    var json_gravite = "";
    var gravite ="";
    $.ajax({
        url: 'content/php/atelier1c/gravite_choisie.php',
        type: 'POST',
        success: function (data) {
            gravite = data;
            if (gravite == 4) {
                json_gravite = '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}';
            }
            else {
                json_gravite = '{"1" : "1", "2" : "2", "3" : "3", "4" : "4", "5" : "5"}';
            }
            $('#tableau_er').Tabledit({
                url: 'content/php/atelier1c/modification.php',
                sortable: true,
                columns: {
                    identifier: [0, 'id_evenement_redoute'],
                    editable: [
                        // [1, 'nom_valeur_metier'],
                        [2, 'nom_evenement_redoute'],
                        [3, 'description_evenement_redoute'],
                        [4, 'impact'], 
                        [5, 'confidentialite', '{"1" : "1", "2" : "2", "3" : "3"}'],
                        [6, 'integrite', '{"1" : "1", "2" : "2", "3" : "3"}'],
                        [7, 'disponibilite', '{"1" : "1", "2" : "2", "3" : "3"}'],
                        [8, 'tracabilite', '{"1" : "1", "2" : "2", "3" : "3"}'],
                        [9, 'niveau_de_gravite', json_gravite]
                    ],
                },
                restoreButton: false,
                onSuccess: function (data, textStatus, jqXHR) {
                    if (data.action == 'delete') {
                        $('#' + data.id_evenement_redoutes).remove();
                    }
                }
            });
        }
    }) 
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_echelle","#editable_table tbody tr")
setSortTable('tableau_niveau');
OURJQUERYFN.setFilterTable("#rechercher_niveau","#tableau_niveau tbody tr")
setSortTable('tableau_er');
OURJQUERYFN.setFilterTable("#rechercher_er","#tableau_er tbody tr")

/*------------------------- AUTO-CHARGEMENT DROP-DOWN ----------------------*/
var nomechelleprojet = document.getElementById('nomechelleprojet');
$.ajax({
    url: 'content/php/atelier1c/selection_echelle_projet.php',
    type: 'POST',
    dataType: 'html',
    success: function (resultat) {
        var echelle_projet_JSON = JSON.parse(resultat);
        nomechelleprojet.value = echelle_projet_JSON[0][0]       
    },
    error: function (erreur) {
        alert('ERROR :' + erreur);
    }
});

/*------------------------------ LABELS CACHES ------------------------------*/
label_er.style.display="none"
label_echelle.style.display="none"

/*----------------------- ENREGISTREMENT DES COOKIES ------------------------*/
nomechelle.addEventListener('keyup',function(event){
    verify_input(nomechelle.value,regex_nom,nomechelle)
    activate_label(nomechelle.value,label_echelle)
}) 

nom_er.addEventListener('keyup',function(event){
    verify_input(nom_er.value,regex_nom,nom_er)
    activate_label(nom_er.value,label_er)
}) 

description_er.addEventListener('keyup',function(event){
    verify_textarea(description_er.value,regex_description,description_er)
})

impact.addEventListener('keyup',function(event){
    verify_textarea(impact.value,regex_description,impact)
})
/*--------------------------- Couleurs Gravité --------------------------*/
$("#tableau_er > tbody > tr > td:nth-child(10)").each(function () {

    if ($(this)[0].innerText == "1") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "2") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "3") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "4") { $(this)[0].classList.add('fond-rouge'); }
    if ($(this)[0].innerText == "5") { $(this)[0].classList.add('fond-rouge'); }

});
