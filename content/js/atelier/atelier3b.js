/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var scenariostrategique = document.getElementById("nom_scenario_strategique");
var label_scenariostrategique = document.getElementById("nom_scenario_strategique").previousSibling.previousSibling

var id_risque = document.getElementById("id_risque");
var cheminattaque = document.getElementById("chemin_d_attaque_strategique")
var label_id_risque = document.getElementById("id_risque").previousSibling.previousSibling

var regex_nom = /^[a-zA-Z0-9éèàêâùïüëç\s-./:,'"]{1,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëç\s-.]{1,1000}$/

var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;
var k=0;
var l=0;
var m=0;

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
            // checkboxeditable: [
            //     [5, 'confidentialite'],
            //     [6, 'integrite'],
            //     [7, 'disponibilite'],
            //     [8, 'tracabilite']
            // ]
        },
        eventType: 'none',
        restoreButton: false,
        editButton: false,
        deleteButton: false,
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
        deleteButton: false,
    });
});
$(document).ready(function () {
    $.ajax({
        url: 'content/php/atelier3b/choixscenar.php',
        type: 'POST',
        success: function(data){
            // console.log(data);
            // var SROV = data[0];
            // var ER = data[1];
            // console.log(SROV);
            // console.log(ER);
        }
    })
    $('#editable_table_scenario_strategique').Tabledit({
        url: 'content/php/atelier3b/modification_scenario.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_scenario_strategique'],
            editable: [
                [1, 'nom_scenario_strategique'],
                // [2, 'id_source_de_risque'],
                // [3, 'id_evenement_redoute'],
            ],
            checkboxeditable: []
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_evenement_redoutes).remove();
            }
        }
    });
});
$(document).ready(function () {
    $('#editable_table_chemin_d_attaque').Tabledit({
        url: 'content/php/atelier3b/modification_chemin.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_chemin_d_attaque_strategique'],
            editable: [
                [3, 'chemin_d_attaque_strategique']
            ],
            checkboxeditable: []
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_evenement_redoutes).remove();
            }
        }
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

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
// sleep(100).then(() => {
//     for(let i=0;i<editable_table_scenario_strategique.rows.length-1;i++){
//         j=i+1;
//         button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table_scenario_strategique'+','+'5'+')')
//     }
// });

// sleep(100).then(() => {
//     for(let i=editable_table_chemin_d_attaque.rows.length-1;i<editable_table_scenario_strategique.rows.length+editable_table_chemin_d_attaque.rows.length-2;i++){
//         k++;
//         button[i].setAttribute('onclick','tableau_verification('+k+','+'editable_table_chemin_d_attaque'+','+'5'+')')
//     }
// });

// sleep(100).then(() => {
//     for(let i=editable_table.rows.length+editable_table_SROV.rows.length-2;i<editable_table.rows.length+editable_table_SROV.rows.length+editable_table_scenario_strategique.rows.length-3;i++){
//         l++;
//         button[i].setAttribute('onclick','tableau_verification('+l+','+'editable_table_scenario_strategique'+','+'6'+')')
//     }
// });

// sleep(100).then(() => {
//     for(let i=editable_table.rows.length+editable_table_SROV.rows.length+editable_table_scenario_strategique.rows.length-3;i<editable_table.rows.length+editable_table_SROV.rows.length+editable_table_scenario_strategique.rows.length+editable_table_chemin_d_attaque.rows.length-4;i++){
//         m++;
//         button[i].setAttribute('onclick','tableau_verification('+l+','+'editable_table_chemin_d_attaque'+','+'4'+')')
//     }
// });

/*------------------------------ LABELS CACHES ------------------------------*/
label_scenariostrategique.style.display="none"
label_id_risque.style.display="none"

/*----------------------- ENREGISTREMENT DES COOKIES ------------------------*/
scenariostrategique.addEventListener('keyup',function(event){
    verify_input(scenariostrategique.value,regex_nom,scenariostrategique)
    activate_label(scenariostrategique.value,label_scenariostrategique)
}) 

id_risque.addEventListener('keyup',function(event){
    verify_input(id_risque.value,regex_nom,id_risque)
    activate_label(id_risque.value,label_id_risque)
}) 

cheminattaque.addEventListener('keyup',function(event){
    verify_textarea(cheminattaque.value,regex_description,cheminattaque)
})
