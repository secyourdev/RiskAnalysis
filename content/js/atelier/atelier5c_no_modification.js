/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");
/*------------------------------- SIDEBAR ----------------------------------*/
show_sub_content()
sidebarToggleTop.addEventListener('click', show_sub_content,false);
sidebarToggle.addEventListener('click',show_sub_content,false);
window.addEventListener('resize', show_sub_content, false);
function show_sub_content(){
    var Atelier5 = document.getElementById('Atelier5');
    if(!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(min-width: 768px)").matches)){
        Atelier5.classList.add('show')
    }
}
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'content/php/atelier5c/modification.php',
        columns: {
            identifier: [0, 'id_revaluation'],
            editable: [],
        },
        deleteButton: false,
        editButton: false,
        restoreButton: false
    });
});
/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_srov","#editable_table tbody tr")
