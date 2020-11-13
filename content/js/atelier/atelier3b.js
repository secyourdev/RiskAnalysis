/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var scenariostrategique = document.getElementById("nom_scenario_strategique");
var label_scenariostrategique = document.getElementById("nom_scenario_strategique").previousSibling.previousSibling

var id_risque = document.getElementById("id_risque");
var cheminattaque = document.getElementById("chemin_d_attaque_strategique")
var cheminattaque_description = document.getElementById("description")
var label_id_risque = document.getElementById("id_risque").previousSibling.previousSibling

var regex_nom = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{0,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{0,100}$/

var id_scenario_strategique_schema;

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
        },
        eventType: 'none',
        restoreButton: false,
        editButton: false,
        deleteButton: false
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
        deleteButton: false
    });
});
$(document).ready(function () {
    $.ajax({
        url: 'content/php/atelier3b/choixscenar.php',
        type: 'POST',
        success: function(data){
        }
    })
    $('#editable_table_scenario_strategique').Tabledit({
        url: 'content/php/atelier3b/modification_scenario.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_scenario_strategique'],
            editable: [
                [1, 'nom_scenario_strategique'],
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
                [3, 'chemin_d_attaque_strategique'],[4, 'description'],
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
setSortTable('editable_table_chemin_d_attaque');
OURJQUERYFN.setFilterTable("#rechercher_chemin_d_attaque","#editable_table_chemin_d_attaque tbody tr")
/*------------------------------ LABELS CACHES ------------------------------*/
label_scenariostrategique.style.display="none"
label_id_risque.style.display="none"
/*----------------------- -- VERIFICATION DES CHAMPS -- ------------------------*/
scenariostrategique.addEventListener('keyup',function(event){
    verify_input(scenariostrategique.value,regex_nom,scenariostrategique)
    activate_label(scenariostrategique.value,label_scenariostrategique)
}) 

id_risque.addEventListener('keyup',function(event){
    verify_input(id_risque.value,regex_nom,id_risque)
    activate_label(id_risque.value,label_id_risque)
}) 

cheminattaque.addEventListener('keyup',function(event){
    verify_textarea(cheminattaque.value,regex_nom,cheminattaque)
})

cheminattaque_description.addEventListener('keyup',function(event){
    verify_textarea(cheminattaque_description.value,regex_description,cheminattaque_description)
})
/*--------------------------- Couleurs 1.c > gravité --------------------------*/
$("#editable_table > tbody > tr > td:nth-child(10)").each(function () {
    if ($(this)[0].innerText == "1") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "2") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "3") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "4") { $(this)[0].classList.add('fond-rouge'); }
    if ($(this)[0].innerText == "5") { $(this)[0].classList.add('fond-rouge'); }
});

/*-------------------------- Couleurs scénario > gravité ---------------------*/
$("#editable_table_scenario_strategique > tbody > tr > td:nth-child(5)").each(function () {
    if ($(this)[0].innerText == "1") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "2") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "3") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "4") { $(this)[0].classList.add('fond-rouge'); }
    if ($(this)[0].innerText == "5") { $(this)[0].classList.add('fond-rouge'); }
});
/*----------------------------- EXPORT EXCEL --------------------------------*/
var d = new Date();

export_table_to_excel('editable_table','#button_download_evenements_redoutes','projet_'+id_projet+'_evenements_redoutes_'+d.YYYYMMDDHHMMSS()+'.xlsx')
export_table_to_excel('editable_table_SROV','#button_download_SROV','projet_'+id_projet+'_SROV_'+d.YYYYMMDDHHMMSS()+'.xlsx')
export_table_to_excel('editable_table_scenario_strategique','#button_download_scenarios_strategiques','projet_'+id_projet+'_scenarios_strategiques_'+d.YYYYMMDDHHMMSS()+'.xlsx')
export_table_to_excel('editable_table_chemin_d_attaque','#button_download_chemins_d_attaque','projet_'+id_projet+'_chemins_d_attaque_'+d.YYYYMMDDHHMMSS()+'.xlsx')

/*------------------------------- SCHEMAS -----------------------------------*/
/*----------------------------- TRAITEMENTS ---------------------------------*/
/*--------------------- RECUPERATION DU SCHEMA SUR BDD ----------------------*/
recuperation_schema_fn()
/*------------- RECUPERATION INFORMATION PROJET POUR SCHEMA -----------------*/
recuperation_valeur_metier_fn()
/*----------------- RECUPERATION SROV PROJET POUR SCHEMA --------------------*/
recuperation_SROV_fn()
/*---------- RECUPERATION PARTIE PARTANTE PROJET POUR SCHEMA ----------------*/
recuperation_partie_prenante_fn()
/*------------------------------- FONCTION ----------------------------------*/
/*--------------------- RECUPERATION DU SCHEMA SUR BDD ----------------------*/
function recuperation_schema_fn(){
    for(let i=0;i<lenght_modifier_schema;i++){
        modifier_schema[i].addEventListener('click',function(){

            $.ajax({
                url: 'content/php/atelier3b/selection_schema.php',
                type: 'POST',
                data: {
                    id_scenario_strategique: modifier_schema[i].parentNode.parentNode.id,
                },
                dataType: 'html',
                success: function (resultat) {
                    var schema_JSON = JSON.parse(resultat);
                    $.get(schema_JSON[0][0], openDiagram, 'text');
                    id_scenario_strategique_schema = modifier_schema[i].parentNode.parentNode.id
                    titre_schema.innerText='Schéma du scénario stratégique - '+modifier_schema[i].parentNode.parentNode.childNodes[3].innerText
                    name_file = suppression_espace(name_schema(id_projet,modifier_schema[i].parentNode.parentNode.childNodes[3].innerText.toLowerCase()))
                }
            })
        });
    }
}
/*------------ RECUPERATION VALEUR METIER PROJET POUR SCHEMA -----------------*/
function recuperation_valeur_metier_fn(){
    for(let i=0;i<lenght_modifier_schema;i++){
        modifier_schema[i].addEventListener('click',function(){

            $.ajax({
                url: 'content/php/atelier3b/selection_valeur_metier.php',
                type: 'POST',
                data: {
                    id_scenario_strategique: modifier_schema[i].parentNode.parentNode.id,
                },
                dataType: 'html',
                success: function (resultat) {
                    var valeur_metier_JSON = JSON.parse(resultat);
                    console.log("Valeur métier :")
                    console.log(valeur_metier_JSON)
                }
            })
        });
    }
}

/*----------------- RECUPERATION SROV PROJET POUR SCHEMA --------------------*/
function recuperation_SROV_fn(){
    for(let i=0;i<lenght_modifier_schema;i++){
        modifier_schema[i].addEventListener('click',function(){

            $.ajax({
                url: 'content/php/atelier3b/selection_SROV.php',
                type: 'POST',
                data: {
                    id_scenario_strategique: modifier_schema[i].parentNode.parentNode.id,
                },
                dataType: 'html',
                success: function (resultat) {
                    var SROV_JSON = JSON.parse(resultat);
                    console.log("SROV :")
                    console.log(SROV_JSON)
                }
            })
        });
    }
}
/*---------- RECUPERATION PARTIE PARTANTE PROJET POUR SCHEMA ----------------*/
function recuperation_partie_prenante_fn(){
    for(let i=0;i<lenght_modifier_schema;i++){
        modifier_schema[i].addEventListener('click',function(){

            $.ajax({
                url: 'content/php/atelier3b/selection_partie_prenante.php',
                type: 'POST',
                success: function (resultat) {
                    var partie_prenante_JSON = JSON.parse(resultat);
                    console.log("Partie Prenantes :")
                    console.log(partie_prenante_JSON)
                }
            })
        });
    }
}
/*----------------------- AJOUT DU SCHEMA SUR BDD ---------------------------*/
function enregistrement_schema_fn(schema_file){     
    $.ajax({
        url: 'content/php/atelier3b/ajout_schema.php',
        type: 'POST',
        data: {
            id_scenario_operationnel: id_scenario_operationnel_schema,
            schema : schema_file
        }
    })
}