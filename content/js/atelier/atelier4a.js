/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var modeope = document.getElementById("modeope");

var regex_description = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{0,100}$/

var id_scenario_operationnel_schema;
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
var d = new Date();

export_table_to_excel('editable_table','#button_download_scenarios_strategiques','scenarios_strategiques_'+d.YYYYMMDDHHMMSS()+'.xlsx')
export_table_to_excel('tableau_ope','#button_download_scenario_operationnel','scenario_operationnel_'+d.YYYYMMDDHHMMSS()+'.xlsx')
export_table_to_excel('tableau_mode_ope','#button_download_mode_operatoire','mode_operatoire_'+d.YYYYMMDDHHMMSS()+'.xlsx')

/*------------------------------- SCHEMAS -----------------------------------*/
/*---------------------- RECUPERATION en BDD DU SCHEMA ----------------------*/
recuperation_schema_fn()
/*---------------------- RECUPERATION DU SCHEMA SUR BDD ---------------------*/
function recuperation_schema_fn(){
    for(let i=0;i<lenght_modifier_schema;i++){
        modifier_schema[i].addEventListener('click',function(){

            $.ajax({
                url: 'content/php/atelier4a/selection_schema.php',
                type: 'POST',
                data: {
                    id_scenario_operationnel: modifier_schema[i].parentNode.parentNode.id,
                },
                dataType: 'html',
                success: function (resultat) {
                    var schema_JSON = JSON.parse(resultat);
                    $.get(schema_JSON[0][0], openDiagram, 'text');
                    id_scenario_operationnel_schema = modifier_schema[i].parentNode.parentNode.id
                    titre_schema.innerText='Schéma du scénario opérationnel - '+modifier_schema[i].parentNode.parentNode.childNodes[5].innerText
                    name_file = suppression_espace(name_schema(id_projet,modifier_schema[i].parentNode.parentNode.childNodes[5].innerText.toLowerCase()))
                }
            })
        });
    }
}
/*----------------------- AJOUT DU SCHEMA SUR BDD --------------------------*/
function enregistrement_schema_fn(schema_file){     
        $.ajax({
            url: 'content/php/atelier4a/ajout_schema.php',
            type: 'POST',
            data: {
                id_scenario_operationnel: id_scenario_operationnel_schema,
                schema : schema_file
            }
        })
}
