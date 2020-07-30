/*------------------------------ VARIABLES ----------------------------------*/
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
            editable: [],
            dateeditable: []
        },
        restoreButton: false,
        deleteButton: false,
        editButton: false
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_pacs","#editable_table tbody tr")
/*--------------------------- Couleurs pacs > statut --------------------------*/
$("#editable_table > tbody > tr > td:nth-child(9)").each(function () {

    if ($(this)[0].innerText == "Terminé") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "En cours") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "A lancer") { $(this)[0].classList.add('fond-rouge'); }

});
/*------------------------------ LABELS CACHES ------------------------------*/
label_nom.style.display="none"
/*-------------------------- VERIFICATION DES CHAMPS ------------------------*/
nom_mesure.addEventListener('keyup',function(event){
    verify_input(nom_mesure.value,regex_nom,nom_mesure)
    activate_label(nom_mesure.value,label_nom)
}) 

description_mesure.addEventListener('keyup',function(event){
    verify_textarea(description_mesure.value,regex_description,description_mesure)
})
