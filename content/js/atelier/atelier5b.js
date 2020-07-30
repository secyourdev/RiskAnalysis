/*------------------------------ VARIABLES ----------------------------------*/
var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')

var nom_mesure = document.getElementById('nommesure')
var description_mesure = document.getElementById('descriptionmesure')

var label_nom = document.getElementById('nommesure').previousSibling.previousSibling
var label_description = document.getElementById('descriptionmesure').previousSibling.previousSibling


var regex_nom = /^[a-zA-Z0-9éèàêâùïüëç\s-./:,'"]{0,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëç\s-.:,'"]{0,1000}$/

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

// $(document).ready(function () {
//     $('#editable_table').Tabledit({
//         url: 'content/php/atelier5b/modificationtableau.php',
//         columns: {
//             identifier: [0, 'id_mesure'],
//             editable: [
//             [12, 'dependance_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
//             [13, 'penetration_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
//             [14, 'maturite_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
//             [15, 'confiance_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
//             [20, 'nom_mesure_securite'],
//             [21, 'description_mesure_securite']
//         ],
//         dateeditable: [] 
//         },
//         restoreButton: false,
//         // onSuccess: function (data, textStatus, jqXHR) {
//         //     if (data.action == 'delete') {
//         //         $('#' + data.id_source_de_risque).remove();
//         //     }
//         // }
//     });
// });

$(document).ready(function () {

    $('#editable_table').Tabledit({
        url: 'content/php/atelier5b/modificationpacs.php',
        columns: {
            identifier: [0, 'id_traitement_de_securite'],
            editable: [
                [3, 'principe_de_securite', '{"Gouvernance" : "Gouvernance", "Protection" : "Protection", "Defense" : "Defense", "Resilience" : "Resilience"}'],
                [4, "responsable"],
                [5, "difficulte_traitement_de_securite"],
                [6, "cout_traitement_de_securite", '{"+" : "+", "++" : "++", "+++" : "+++"}'],
                // [7, "date_traitement_de_securite"],
                [8, "statut", '{"A lancer" : "A lancer", "En cours" : "En cours", "Terminé" : "Terminé"}']],

            // editable:[[4, "vraisemblance", '{"1" : "1 (Invraisemblable)", "2" : "2 (Peu vraisemblable)", "3" : "3 (Vraisemblable)", "4" : "4 (Très vraisemblable)", "5" : "5 (Quasi certain)"}']]
            dateeditable: [[7, 'date_traitement_de_securite']]

        },
        restoreButton: false,
        deleteButton: false

    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
// setSortTable('editable_table');
// OURJQUERYFN.setFilterTable("#rechercher_tableau","#editable_table tbody tr")
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_pacs","#editable_table tbody tr")

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'9'+')')
    }
});




/*--------------------------- Couleurs pacs > statut --------------------------*/
$("#editable_table > tbody > tr > td:nth-child(9)").each(function () {

    if ($(this)[0].innerText == "Terminé") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "En cours") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "A lancer") { $(this)[0].classList.add('fond-rouge'); }

});

/*------------------------------ LABELS CACHES ------------------------------*/
label_nom.style.display="none"

/*----------------------- ENREGISTREMENT DES COOKIES ------------------------*/
nom_mesure.addEventListener('keyup',function(event){
    verify_input(nom_mesure.value,regex_nom,nom_mesure)
    activate_label(nom_mesure.value,label_nom)
}) 

description_mesure.addEventListener('keyup',function(event){
    verify_textarea(description_mesure.value,regex_description,description_mesure)
})
