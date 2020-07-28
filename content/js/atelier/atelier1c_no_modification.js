/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

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
      editable:[]
     },
     restoreButton:false,
     editButton: false,
     deleteButton: false,
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
                    editable: [],
                },
                restoreButton: false,
                editButton: false,
                deleteButton: false,
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

/*--------------------------- Couleurs Gravité --------------------------*/
$("#tableau_er > tbody > tr > td:nth-child(10)").each(function () {

    if ($(this)[0].innerText == "1") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "2") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "3") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "4") { $(this)[0].classList.add('fond-rouge'); }
    if ($(this)[0].innerText == "5") { $(this)[0].classList.add('fond-rouge'); }

});