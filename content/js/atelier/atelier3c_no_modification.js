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
            identifier: [0, 'id_partie_prenante'],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});

$(document).ready(function () {
    $('#editable_table_scenario_strategique').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_scenario_strategique'],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});


$(document).ready(function () {
    $('#editable_table_mesure').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_mesure'],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});

$(document).ready(function () {
    $('#editable_table_mesure2').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_partie_prenante'],
            editable: []
        },
        editButton: false,
        deleteButton: false,
        restoreButton: false
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_partie_prenante", "#editable_table tbody tr")
setSortTable('editable_table_scenario_strategique');
OURJQUERYFN.setFilterTable("#rechercher_scenario_strategique", "#editable_table_scenario_strategique tbody tr")
setSortTable('editable_table_mesure');
OURJQUERYFN.setFilterTable("#rechercher_mesure", "#editable_table_mesure tbody tr")

$("#editable_table > tbody > tr > td:nth-child(10)").each(function () {
    if ($(this)[0].innerText == "Pas critique") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "Critique") { $(this)[0].classList.add('fond-rouge'); }
});