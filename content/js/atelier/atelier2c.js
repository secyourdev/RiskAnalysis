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
        url: 'content/php/atelier2c/modification.php',
        deleteButton: false,
        columns: {
            identifier: [0, 'id_source_de_risque'],
            editable: [
                [13, 'choix_source_de_risque', '{"..." : "...", "P1": "P1", "P2": "P2"}']
            ],
        },
        restoreButton: false,
    });
});
/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_srov","#editable_table tbody tr")
/*----------------------------- EXPORT EXCEL --------------------------------*/
var d = new Date();

export_table_to_excel('editable_table','#button_download_choix_SR','choix_SR_'+d.YYYYMMDDHHMMSS()+'.xlsx')
