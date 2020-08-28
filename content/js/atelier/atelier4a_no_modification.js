/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");
/*------------------------------- SIDEBAR ----------------------------------*/
show_sub_content()
sidebarToggleTop.addEventListener('click', show_sub_content,false);
sidebarToggle.addEventListener('click',show_sub_content,false);
window.addEventListener('resize', show_sub_content, false);
function show_sub_content(){
    var Atelier1 = document.getElementById('Atelier4');
    if(!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(min-width: 768px)").matches)){
        Atelier1.classList.add('show')
    }
}
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function(){  
    
    $('#editable_table').Tabledit({
     columns:{
      identifier:[0, 'id_scenario_strategique'],
      editable:[]
     },
     restoreButton:false,
     editButton: false,
     deleteButton: false
    
    });

    $('#tableau_ope').Tabledit({
     deleteButton: false,
     columns:{
      identifier:[0, "id_scenario_operationnel"],
      editable:[]
     },
     restoreButton:false,
     editButton: false,
     deleteButton: false
    });

    $('#tableau_mode_ope').Tabledit({
     columns:{
      identifier:[0, "id_mode_operatoire"],
      editable:[]
     },
     restoreButton:false,
     editButton: false,
     deleteButton: false
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_chemin","#editable_table tbody tr")
setSortTable('tableau_ope');
OURJQUERYFN.setFilterTable("#rechercher_ope","#tableau_ope tbody tr")
setSortTable('tableau_mode_ope');
OURJQUERYFN.setFilterTable("#rechercher_mode_ope","#tableau_mode_ope tbody tr")

/*-------------------------- VERIFICATION DES CHAMPS -----------------------*/
modeope.addEventListener('keyup',function(event){
    verify_textarea(modeope.value,regex_description,modeope)
})
/*--------------------------- Couleurs scénario > gravité --------------------------*/
$("#editable_table > tbody > tr > td:nth-child(8)").each(function () {

    if ($(this)[0].innerText == "1") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "2") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "3") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "4") { $(this)[0].classList.add('fond-rouge'); }
    if ($(this)[0].innerText == "5") { $(this)[0].classList.add('fond-rouge'); }

});
/*----------------------------- EXPORT EXCEL --------------------------------*/
export_table_to_excel('editable_table','#button_download_scenarios_strategiques','scenarios_strategiques.xlsx')
export_table_to_excel('tableau_ope','#button_download_scenario_operationnel','scenario_operationnel.xlsx')
export_table_to_excel('tableau_mode_ope','#button_download_mode_operatoire','mode_operatoire.xlsx')
