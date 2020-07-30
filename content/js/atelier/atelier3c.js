/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var nommesure = document.getElementById("nommesure");
var descriptionmesure = document.getElementById("descriptionmesure");
var label_mesure = document.getElementById("nommesure").previousSibling.previousSibling

var regex_nom = /^[a-zA-Z0-9éèàêâùïüëç\s-.:,'"]{0,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëç\s-.:,'"]{0,1000}$/

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
            identifier: [0, 'id_partie_prenante'],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false,
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
        deleteButton: false,
    });
});


$(document).ready(function () {
    $('#editable_table_mesure').Tabledit({
        url: 'content/php/atelier3c/modification_mesure1.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_mesure'],
            editable: [
                [3, 'nom_mesure_securite'],
                [4, 'description_mesure_securite']
            ]
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
    $('#editable_table_mesure2').Tabledit({
        url: 'content/php/atelier3c/modification_mesure2.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_partie_prenante'],
            editable: [

                [3, 'dependance_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
                [4, 'penetration_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
                [5, 'maturite_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
                [6, 'confiance_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}']
            ]
        },
        deleteButton: false,
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
OURJQUERYFN.setFilterTable("#rechercher_partie_prenante", "#editable_table tbody tr")
/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table_scenario_strategique');
OURJQUERYFN.setFilterTable("#rechercher_scenario_strategique", "#editable_table_scenario_strategique tbody tr")
/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table_mesure');
OURJQUERYFN.setFilterTable("#rechercher_mesure", "#editable_table_mesure tbody tr")

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<editable_table_mesure.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table_mesure'+','+'11'+')')
    }
});

/*------------------------------ LABELS CACHES ------------------------------*/
label_mesure.style.display="none"

/*----------------------- ENREGISTREMENT DES COOKIES ------------------------*/
nommesure.addEventListener('keyup',function(event){
    verify_input(nommesure.value,regex_nom,nommesure)
    activate_label(nommesure.value,label_mesure)
}) 

descriptionmesure.addEventListener('keyup',function(event){
    verify_textarea(descriptionmesure.value,regex_description,descriptionmesure)
})
