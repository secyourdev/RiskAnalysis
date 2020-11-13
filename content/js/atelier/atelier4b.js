/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var nomechelle = document.getElementById("nom_echelle");
var label_echelle = document.getElementById("nom_echelle").previousSibling.previousSibling

var nomechelleprojet = document.getElementById('nomechelleprojet');
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
    $('#editable_table_echelle').Tabledit({
     url:'content/php/echelle/modification_echelle_vraisemblance.php',
     columns:{
      identifier:[0, 'id_echelle'],
      editable:[[1, 'nom_echelle'], [2, 'nb_niveau_echelle', '{"4" : "4", "5" : "5"}']]
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


$(document).ready(function(){  
    $.ajax({
        url: 'content/php/atelier4b/vraisemblance.php',
        type: 'POST',
        success: function (data){
            var projet_JSON = JSON.parse(data);
            var $id_echelle = projet_JSON[0][0];
            var $id_nb_niveau_echelle = projet_JSON[0][1];
            nomechelleprojet.value = $id_echelle;
            if ($id_nb_niveau_echelle == 4){
                valeurs = '{"1" : "1 (Invraisemblable)", "2" : "2 (Peu vraisemblable)", "3" : "3 (Vraisemblable)", "4" : "4 (Très vraisemblable)"}';
            }
            else {
                valeurs = '{"1" : "1 (Invraisemblable)", "2" : "2 (Peu vraisemblable)", "3" : "3 (Vraisemblable)", "4" : "4 (Très vraisemblable)", "5" : "5 (Quasi certain)"}';
            }
            $('#editable_table').Tabledit({
                url:'content/php/atelier4b/modification.php',
             columns:{
              identifier:[0, 'id_scenario_operationnel'],
              editable:[[4, "vraisemblance", valeurs]]
             },
             restoreButton:false,
             deleteButton: false
            
            });

            /*--------------------------- SORT & FILTER TABLES --------------------------*/
            setSortTable('editable_table');
            OURJQUERYFN.setFilterTable("#rechercher_chemin","#editable_table tbody tr");
        }      
    })    
});


/*------------------------- AUTO-CHARGEMENT DROP-DOWN ----------------------*/
var nomechelleprojet = document.getElementById('nomechelleprojet');
$.ajax({
    url: 'content/php/atelier4b/selection_echelle_projet_vraisemblance.php',
    type: 'POST',
    dataType: 'html',
    success: function (resultat) {
        var echelle_projet_JSON = JSON.parse(resultat);
        nomechelleprojet.value = echelle_projet_JSON[0][0];       
    },
    error: function (erreur) {
        alert('ERROR :' + erreur);
    }
});


$("#editable_table > tbody > tr > td:nth-child(5)").each(function () {
    if ($(this)[0].innerText == "1") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "2") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "3") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "4") { $(this)[0].classList.add('fond-rouge'); }
    if ($(this)[0].innerText == "5") { $(this)[0].classList.add('fond-rouge'); }

});

/*----------------------------- EXPORT EXCEL --------------------------------*/
var d = new Date();
export_table_to_excel('editable_table','#button_download_vraisemblance','vraisemblance_'+d.YYYYMMDDHHMMSS()+'.xlsx')
