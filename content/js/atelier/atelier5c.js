/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

//var valeurvraisemblance = document.getElementById('valeurvraisemblance');
var valeurs = {};
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
    $.ajax({
        url: 'content/php/atelier4b/vraisemblance.php',
        type: 'POST',
        success: function (data){
            //console.log(data);
            if (data == 4){
                valeurs = '{"1" : "1 (Invraisemblable)", "2" : "2 (Peu vraisemblable)", "3" : "3 (Vraisemblable)", "4" : "4 (Très vraisemblable)"}';
            }
            else {
                valeurs = '{"1" : "1 (Invraisemblable)", "2" : "2 (Peu vraisemblable)", "3" : "3 (Vraisemblable)", "4" : "4 (Très vraisemblable)", "5" : "5 (Quasi certain)"}';
            }
            $('#editable_table').Tabledit({
                url: 'content/php/atelier5c/modification.php',
                columns: {
                    identifier: [0, 'id_revaluation'],
                    editable: [
                        [7, 'nom_risque_residuelle'],
                        [8, 'description_risque_residuelle'],
                        [9, 'vraisemblance_residuelle', valeurs], 
                        [11, 'gestion_risque_residuelle']
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
        }
    }); 
});
/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_srov","#editable_table tbody tr")
/*----------------------------- EXPORT EXCEL --------------------------------*/
export_table_to_excel('editable_table','#button_download_evaluation_documentation_risques_risiduels','evaluation_documentation_risques_risiduels.xlsx')