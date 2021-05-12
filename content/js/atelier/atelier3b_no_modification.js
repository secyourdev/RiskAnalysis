/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");
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
        sortable: true,
        columns: {
            identifier: [0, 'id_evenement_redoutes'],
            editable: [],
        },
        eventType: 'none',
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});
$(document).ready(function () {
    $('#editable_table_SROV').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_source_de_risque'],
            editable: [],
            checkboxeditable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});
$(document).ready(function () {
    $.ajax({
        url: 'content/php/atelier3b/choixscenar.php',
        type: 'POST',
        success: function(data){
        }
    })
    $('#editable_table_scenario_strategique').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_scenario_strategique'],
            editable: [],
            checkboxeditable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});
$(document).ready(function () {
    $('#editable_table_chemin_d_attaque').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_chemin_d_attaque_strategique'],
            editable: [],
            checkboxeditable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_evenement_redoute","#editable_table tbody tr")
setSortTable('editable_table_SROV');
OURJQUERYFN.setFilterTable("#rechercher_srov","#editable_table_SROV tbody tr")
setSortTable('editable_table_scenario_strategique');
OURJQUERYFN.setFilterTable("#rechercher_scenario_strategique","#editable_table_scenario_strategique tbody tr")
setSortTable('editable_table_chemin_d_attaque');
OURJQUERYFN.setFilterTable("#rechercher_chemin_d_attaque","#editable_table_chemin_d_attaque tbody tr")

/*--------------------------- Couleurs 1.c > gravité --------------------------*/
$("#editable_table > tbody > tr > td:nth-child(10)").each(function () {
    if ($(this)[0].innerText == "1") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "2") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "3") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "4") { $(this)[0].classList.add('fond-rouge'); }
    if ($(this)[0].innerText == "5") { $(this)[0].classList.add('fond-rouge'); }
});

/*--------------------------- Couleurs scénario > gravité --------------------------*/
$("#editable_table_scenario_strategique > tbody > tr > td:nth-child(5)").each(function () {
    if ($(this)[0].innerText == "1") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "2") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "3") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "4") { $(this)[0].classList.add('fond-rouge'); }
    if ($(this)[0].innerText == "5") { $(this)[0].classList.add('fond-rouge'); }
});
/*----------------------------- EXPORT EXCEL --------------------------------*/
var d = new Date();

export_table_to_excel('editable_table','#button_download_evenements_redoutes','evenements_redoutes_'+d.YYYYMMDDHHMMSS()+'.xlsx')
export_table_to_excel('editable_table_SROV','#button_download_SROV','SROV_'+d.YYYYMMDDHHMMSS()+'.xlsx')
export_table_to_excel('editable_table_scenario_strategique','#button_download_scenarios_strategiques','scenarios_strategiques_'+d.YYYYMMDDHHMMSS()+'.xlsx')
export_table_to_excel('editable_table_chemin_d_attaque','#button_download_chemins_d_attaque','chemins_d_attaque_'+d.YYYYMMDDHHMMSS()+'.xlsx')