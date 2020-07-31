/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var j=0;

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
        columns: {
            identifier: [0, 'id_source_de_risque'],
            editable: [],
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
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