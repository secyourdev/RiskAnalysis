/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;
var k=0;
var l=0;

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
     url:'content/php/atelier4a/modification.php',
     deleteButton: false,
     columns:{
      identifier:[0, "id_scenario_operationnel"],
      editable:[ [3, 'description_scenario_operationnel']]
     },
     restoreButton:false,
     onSuccess:function(data, textStatus, jqXHR)
     {
      if(data.action == 'delete')
      {
       $('#'+data.id_chemin_d_attaque_strategique).remove();
      }
     }
    });
    $('#tableau_mode_ope').Tabledit({
     url:'content/php/atelier4a/modificationmodeope.php',
     columns:{
      identifier:[0, "id_mode_operatoire"],
      editable:[ [2, 'mode_operatoire']]
     },
     restoreButton:false,
     onSuccess:function(data, textStatus, jqXHR)
     {
      if(data.action == 'delete')
      {
       $('#'+data.id_bien_support).remove();
      }
     }
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_chemin","#editable_table tbody tr")
setSortTable('tableau_ope');
OURJQUERYFN.setFilterTable("#rechercher_ope","#tableau_ope tbody tr")
setSortTable('tableau_mode_ope');
OURJQUERYFN.setFilterTable("#rechercher_mode_ope","#tableau_mode_ope tbody tr")

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
// sleep(100).then(() => {
//     for(let i=0;i<tableau_ope.rows.length-1;i++){
//         j=i+1;
//         button[i].setAttribute('onclick','tableau_verification('+j+','+'tableau_ope'+','+'4'+')')
//     }
// });

// sleep(100).then(() => {
//     for(let i=tableau_ope.rows.length-1;i<tableau_mode_ope.rows.length+tableau_ope.rows.length-2;i++){
//         k++;
//         button[i].setAttribute('onclick','tableau_verification('+k+','+'tableau_mode_ope'+','+'3'+')')
//     }
// });
// sleep(100).then(() => {
//     for(let i=editable_table.rows.length+tableau_vm.rows.length-2;i<editable_table.rows.length+tableau_vm.rows.length+tableau_bs.rows.length-3;i++){
//         l++;
//         button[i].setAttribute('onclick','tableau_verification('+l+','+'tableau_bs'+','+'7'+')')
//     }
// });
