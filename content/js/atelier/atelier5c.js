/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;

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
            identifier: [0, 'id_chemin_d_attaque_strategique'],
            editable: [
                [5, 'nom_risque_residuelle'],
                [6, 'description_risque_residuelle'],
                [7, 'vraisemblance_residuelle'], 
                // [8, 'risque_residuel'],
                [9, 'gestion_risque_residuelle']
            ],
        },
        deleteButton: false,
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_source_de_risque).remove();
            }
        }
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_srov","#editable_table tbody tr")

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'9'+')')
    }
});