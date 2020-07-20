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
                // [1, 'profil_de_l_attaquant_source_de_risque'],
                // [2, 'description_source_de_risque'], 
                // [3, 'objectif_vise'],
                // [4, 'description_objectif_vise'],
                [5, 'motivation', '{"" : "...", "1": "1", "2": "2", "3": "3"}'],
                [6, 'ressources', '{"" : "...", "1": "1", "2": "2", "3": "3"}'],
                [7, 'activite', '{"" : "...", "1": "1", "2": "2", "3": "3"}'],
                [8, 'mode_operatoire'],
                [9, 'secteur_d_activite'],
                [10, 'arsenal_d_attaque'],
                [11, 'faits_d_armes'],
                [12, 'pertinence', '{"Auto" : "Auto", "Faible": "Faible", "Moyen": "Moyen", "Elevé": "Elevé"}'],
            ],
        },
        restoreButton: false,
        // onSuccess: function (data, textStatus, jqXHR) {
        //     if (data.action == 'delete') {
        //         $('#' + data.id_source_de_risque).remove();
        //     }
        // }
    });
});


/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_srov","#editable_table tbody tr")


/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'15'+')')
    }
});