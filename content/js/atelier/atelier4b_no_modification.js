/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var valeurvraisemblance = document.getElementById('valeurvraisemblance');
var valeurs = {};

/*------------------------------- SIDEBAR ----------------------------------*/
show_sub_content()
sidebarToggleTop.addEventListener('click', show_sub_content,false);
sidebarToggle.addEventListener('click',show_sub_content,false);
window.addEventListener('resize', show_sub_content, false);
function show_sub_content(){
    var Atelier1 = document.getElementById('Atelier4');
    if(!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(min-width: 768px)").matches)){
        Atelier1.classList.add('show')
    }
}
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function(){  
    $.ajax({
        url: 'content/php/atelier4b/vraisemblance.php',
        type: 'POST',
        success: function (data){
            valeurvraisemblance.value = data;
            if (data == 4){
                valeurs = '{"1" : "1 (Invraisemblable)", "2" : "2 (Peu vraisemblable)", "3" : "3 (Vraisemblable)", "4" : "4 (Très vraisemblable)"}';
            }
            else {
                valeurs = '{"1" : "1 (Invraisemblable)", "2" : "2 (Peu vraisemblable)", "3" : "3 (Vraisemblable)", "4" : "4 (Très vraisemblable)", "5" : "5 (Quasi certain)"}';
            }
            $('#editable_table').Tabledit({
             columns:{
                identifier:[0, 'id_scenario_operationnel'],
                editable:[]
             },
             restoreButton:false,
             editButton: false,
             deleteButton: false           
            });

            /*--------------------------- SORT & FILTER TABLES --------------------------*/
            setSortTable('editable_table');
            OURJQUERYFN.setFilterTable("#rechercher_chemin","#editable_table tbody tr")
        }      
    })    
});

/*------------------------- AUTO-CHARGEMENT DROP-DOWN ----------------------*/
var valeurvraisemblance = document.getElementById('valeurvraisemblance');
$.ajax({
    url: 'content/php/atelier4b/selection_vraisemblance.php',
    type: 'POST',
    dataType: 'html',
    success: function (resultat) {
        var echelle_projet_JSON = JSON.parse(resultat);
        valeurvraisemblance.innerText = echelle_projet_JSON[0][1]       
    },
    error: function (erreur) {
        alert('ERROR :' + erreur);
    }
});