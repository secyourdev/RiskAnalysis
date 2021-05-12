/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");
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
        columns: {
            identifier: [0, "id_bien_support"],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});
$(document).ready(function () {
    $('#tableau_vm').Tabledit({
        columns: {
            identifier: [0, "id_valeur_metier"],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});
$(document).ready(function () {
    $('#editable_table').Tabledit({
        columns: {
            identifier: [0, 'id_mission'],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_mission", "#editable_table tbody tr")
setSortTable('tableau_vm');
OURJQUERYFN.setFilterTable("#rechercher_valeur_metier", "#tableau_vm tbody tr")
setSortTable('tableau_bs');
OURJQUERYFN.setFilterTable("#rechercher_bien_support", "#tableau_bs tbody tr")

/*----------------------------- EXPORT EXCEL --------------------------------*/
var d = new Date();
export_table_to_excel('editable_table','#button_download_mission','mission_'+ d.YYYYMMDDHHMMSS() +'.xlsx')
export_table_to_excel('tableau_vm','#button_download_vm','valeur_metier_'+ d.YYYYMMDDHHMMSS() +'.xlsx')
export_table_to_excel('tableau_bs','#button_download_bs','bien_support_'+ d.YYYYMMDDHHMMSS() +'.xlsx')