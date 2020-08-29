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

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_evenement_redoute","#editable_table tbody tr")

/*-------------------------------- FONCTIONS --------------------------------*/
function get_database_seuil() {
    $.ajax({
        url: 'content/php/atelier3a/selection_seuil.php',
        type: 'POST',
        dataType: 'html',
        success: function (resultat) {         
            var seuil = JSON.parse(resultat);           
            seuil_danger.innerText = seuil[0]["seuil_danger"]
            seuil_controle.innerText = seuil[0]["seuil_controle"]
            seuil_veille.innerText = seuil[0]["seuil_veille"]
        },
        error: function (erreur) {
            alert('ERROR :' + erreur);
        }
    });
}
get_database_seuil()

/*----------------------------- EXPORT EXCEL --------------------------------*/
var d = new Date();

export_table_to_excel('editable_table','#button_download_parties_prenantes','parties_prenantes_'+d.YYYYMMDDHHMMSS()+'.xlsx')
