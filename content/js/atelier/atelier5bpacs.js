/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j = 0;
var k = 0;
var l = 0;

/*------------------------------- SIDEBAR ----------------------------------*/
show_sub_content()
sidebarToggleTop.addEventListener('click', show_sub_content, false);
sidebarToggle.addEventListener('click', show_sub_content, false);
window.addEventListener('resize', show_sub_content, false);
function show_sub_content() {
    var Atelier1 = document.getElementById('Atelier5');
    if (!accordionSidebar.classList.contains('toggled') && (window.matchMedia("(min-width: 768px)").matches)) {
        Atelier1.classList.add('show')
    }
}
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function () {

    $('#editable_table').Tabledit({
        url: 'content/php/atelier5bpacs/modification.php',
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
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_chemin", "#editable_table tbody tr")

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for (let i = 0; i < editable_table.rows.length - 1; i++) {
        j = i + 1;
        button[i].setAttribute('onclick', 'tableau_verification(' + j + ',' + 'editable_table' + ',' + '8' + ')')
    }
});


