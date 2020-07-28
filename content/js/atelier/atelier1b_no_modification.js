/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j = 0;
var k = 0;
var l = 0;

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
        url: 'content/php/atelier1b/modificationbs.php',
        columns: {
            identifier: [0, "id_bien_support"],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_bien_support).remove();
            }
        }
    });
});
$(document).ready(function () {
    $('#tableau_vm').Tabledit({
        url: 'content/php/atelier1b/modificationvm.php',
        columns: {
            identifier: [0, "id_valeur_metier"],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_valeur_metier).remove();
            }
        }
    });
});
$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'content/php/atelier1b/modificationmission.php',
        columns: {
            identifier: [0, 'id_mission'],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_mission).remove();
            }
        }
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_mission", "#editable_table tbody tr")
setSortTable('tableau_vm');
OURJQUERYFN.setFilterTable("#rechercher_valeur_metier", "#tableau_vm tbody tr")
setSortTable('tableau_bs');
OURJQUERYFN.setFilterTable("#rechercher_bien_support", "#tableau_bs tbody tr")

