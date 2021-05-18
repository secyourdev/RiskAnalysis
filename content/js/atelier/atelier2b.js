/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");
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
        url: 'content/php/atelier2b/modification.php',
        deleteButton: false,
        columns: {
            identifier: [0, 'id_source_de_risque'],
            editable: [
                [5, 'motivation', '{"1": "1", "2": "2", "3": "3"}'],
                [6, 'ressources', '{"1": "1", "2": "2", "3": "3"}'],
                [7, 'activite', '{"1": "1", "2": "2", "3": "3"}'],
                [8, 'mode_operatoire'],
                [9, 'secteur_d_activite'],
                [10, 'arsenal_d_attaque'],
                [11, 'faits_d_armes'],
                [12, 'pertinence', '{"Auto" : "Auto", "Faible": "Faible", "Moyenne": "Moyenne", "Élevée": "Élevée"}'],
            ],
        },
        restoreButton: false,
    });
});


/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_srov","#editable_table tbody tr")
/*--------------------------- Couleurs pertinence --------------------------*/
$("#editable_table > tbody > tr > td:nth-child(13)").each(function () {
    if ($(this)[0].innerText == "Faible") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "Moyenne") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "Élevée") { $(this)[0].classList.add('fond-rouge'); }
});

/*-------------------------- CHOIX AUTO PERTINENCE -------------------------*/  
sleep(100).then(() => {
    var length_pertinence = document.getElementsByName('pertinence').length; 
    for(let i=0;i<length_pertinence;i++){
        document.getElementsByName('pertinence')[i].selectedIndex=0
    }
})

/*----------------------------- EXPORT EXCEL --------------------------------*/
var d = new Date();

export_table_to_excel('editable_table','#button_download_evaluation_SROV','evaluation_SROV_'+d.YYYYMMDDHHMMSS()+'.xlsx')