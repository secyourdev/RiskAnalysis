/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var scenariostrategique = document.getElementById("nom_scenario_strategique");
var label_scenariostrategique = document.getElementById("nom_scenario_strategique").previousSibling.previousSibling

var id_risque = document.getElementById("id_risque");
var cheminattaque = document.getElementById("chemin_d_attaque_strategique")
var cheminattaque_description = document.getElementById("description")
//var label_id_risque = document.getElementById("id_risque").previousSibling.previousSibling

var parametre_schema_scenarios_strategiques = document.getElementById('parametre_schema_scenarios_strategiques')
var titre_parametre_schema = document.getElementById('titre_parametre_schema')

var regex_nom = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{0,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{0,100}$/

var id_scenario_strategique_schema;

var selection;
var valeur_metier_JSON;
var partie_prenante_JSON;
var SROV_JSON;
var evenement_redoutes_JSON;
var fleche_JSON;

var djs_element = document.getElementsByClassName('djs-element')
var box_schema = document.getElementsByClassName('box_schema')
var id_conteneur = document.getElementById('id_conteneur')
var id_choix_value_schema = document.getElementById('id_choix_value_schema')
var id_choix_value_schema_label = document.getElementById('id_choix_value_schema_label')
var id_chemin_value_schema = document.getElementById('id_chemin_value_schema')
var id_chemin_value_schema_label = document.getElementById('id_chemin_value_schema_label')
var valider_choix_value = document.getElementById('valider_choix_value')
var button_EI_IR = document.getElementById('button_EI_IR')
var EI_radio_button = document.getElementById('EI_radio_button')
var ER_radio_button = document.getElementById('ER_radio_button')

var canvas = document.getElementById('canvas'); 
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
                $('#' + data.id_scenario_strategique).remove();
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
                [1, 'id_risque'],[4, 'chemin_d_attaque_strategique'],[5, 'description'],
            ],
            checkboxeditable: []
        },
        restoreButton: false,
        deleteButton: false
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
//label_id_risque.style.display="none"
/*----------------------- -- VERIFICATION DES CHAMPS -- ------------------------*/
scenariostrategique.addEventListener('keyup',function(event){
    verify_input(scenariostrategique.value,regex_nom,scenariostrategique)
    activate_label(scenariostrategique.value,label_scenariostrategique)
}) 

// id_risque.addEventListener('keyup',function(event){
//     verify_input(id_risque.value,regex_nom,id_risque)
//     activate_label(id_risque.value,label_id_risque)
// }) 

// cheminattaque.addEventListener('keyup',function(event){
//     verify_textarea(cheminattaque.value,regex_nom,cheminattaque)
// })

// cheminattaque_description.addEventListener('keyup',function(event){
//     verify_textarea(cheminattaque_description.value,regex_description,cheminattaque_description)
// })
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

/*-------------------------- Couleurs chemin > gravité ----------------------*/
$("#editable_table_chemin_d_attaque > tbody > tr > td:nth-child(7)").each(function () {
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
/*-------------------- RECUPERATION DES DONNEES SUR BDD ---------------------*/
recuperation_valeur_metier_fn()
recuperation_SROV_fn()
recuperation_partie_prenante_fn()
recuperation_evenement_redoute_fn()
/*------------------------- SELECTION SUR SCHEMA ----------------------------*/
canvas.addEventListener('mouseup',function(){
    selection = selection_conteneur() 
    removeOptions(id_choix_value_schema);
    choix_donnees();
    EI_radio_button.checked=true
})

ER_radio_button.addEventListener('click',function(){
    onERButton()
})

EI_radio_button.addEventListener('click',function(){
    onEIButton()
})

// id_conteneur.addEventListener('keydown', function(event){
//     if(((event.keyCode == 8 || event.keyCode == 46) && id_conteneur.value.length == 5) || event.keyCode == 13){
//         event.preventDefault()
//     }
// })

valider_choix_value.addEventListener('click', function(){
    if(id_choix_value_schema.style.display!='none'&&button_EI_IR.style.display=='none')
        document.getElementsByClassName('djs-direct-editing-content')[0].innerText=id_choix_value_schema.selectedOptions[0].innerHTML   
    else if(id_conteneur.style.display!='none'&&button_EI_IR.style.display=='none')
        document.getElementsByClassName('djs-direct-editing-content')[0].innerText=id_conteneur.value;
    else if(button_EI_IR.style.display!='none'){
        if(EI_radio_button.checked){
            document.getElementsByClassName('djs-direct-editing-content')[0].innerText=id_chemin_value_schema.value + " - EI : " + id_conteneur.value;
        }
        else if(ER_radio_button.checked){
            document.getElementsByClassName('djs-direct-editing-content')[0].innerText=id_chemin_value_schema.value + " - ER : " + id_choix_value_schema.selectedOptions[0].innerHTML
        }
        //ajout_fleche()
    }

    $('#parametre_schema_scenarios_strategiques').modal('hide')
})
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
                dataType: 'html',
                success: function (resultat) {
                    valeur_metier_JSON = JSON.parse(resultat);
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
                    SROV_JSON = JSON.parse(resultat);
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
                    partie_prenante_JSON = JSON.parse(resultat);
                }
            })
        });
    }
}

/*--------- RECUPERATION EVENEMENT REDOUTES PROJET POUR SCHEMA --------------*/
function recuperation_evenement_redoute_fn(){
    for(let i=0;i<lenght_modifier_schema;i++){
        modifier_schema[i].addEventListener('click',function(){

            $.ajax({
                url: 'content/php/atelier3b/selection_ER.php',
                type: 'POST',
                success: function (resultat) {
                    evenement_redoutes_JSON = JSON.parse(resultat);
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
            id_scenario_strategique: id_scenario_strategique_schema,
            schema : schema_file
        }
    })
}

/*------------------------- SELECTION SUR SCHEMA ----------------------------*/
function selection_conteneur(){
    for(let i=0;i<djs_element.length;i++){
        if(djs_element[i].classList[2]=='selected'){
            if(djs_element[i].dataset.elementId.substring(0,11)=='Participant'){
                return 'conteneur'
            }
            else if (djs_element[i].dataset.elementId.substring(0,4)=='Flow'){
                return 'fleche'
            }
            else{
                return djs_element[i].childNodes[0].childNodes[0].classList[0]
            }
        }
    }
}

function selection_sr(){
    canvas.addEventListener('mouseup',function(event){
        for(let i=0;i<djs_shape.length;i++){
            if(djs_shape[i].classList[2]=='selected'){
                if(djs_shape[i].childNodes[0].childNodes[0].classList[0]=='schema_source_de_risque'){
                    document.getElementsByClassName('entry fas fa-trash-alt')[0].parentNode.style.display='none'
                    //disableEnterKey(event)
            }
        }
    }
    })
}

function selection_nom_fleche(){
    for(let i=0;i<djs_element.length;i++){
        if(djs_element[i].classList[2]=='selected'){
            if (djs_element[i].dataset.elementId.substring(0,4)=='Flow'){
                return djs_element[i].dataset.elementId;
            }
        }
    }
}

function ajout_fleche(){
    if(selection=='fleche'){
        if(fleche_JSON==''){
            $.ajax({
                url: 'content/php/atelier3b/ajout_fleche.php',
                type: 'POST',
                data:  {
                    valeur_fleche : selection_nom_fleche(),
                    valeur_chemin : id_chemin_value_schema.value,
                    id_scenario_strategique: id_scenario_strategique_schema
                    
                }
            })
        }
        else{
            $.ajax({
                url: 'content/php/atelier3b/modification_fleche.php',
                type: 'POST',
                data:  {
                    valeur_fleche : selection_nom_fleche(),
                    valeur_chemin : id_chemin_value_schema.value,
                    id_scenario_strategique: id_scenario_strategique_schema
                }
            })
        }
    }
}

function recuperation_fleche(){
    $.ajax({
        url: 'content/php/atelier3b/selection_fleche.php',
        type: 'POST',
        data: {
            valeur_fleche : selection_nom_fleche(),
            id_scenario_strategique: id_scenario_strategique_schema
        },
        success: function (resultat) {
            fleche_JSON = JSON.parse(resultat);
        }
    })
}

function choix_donnees(){
    if(selection=='schema_partie_prenante'){
        id_conteneur.style.display='none'
        button_EI_IR.style.display='none'
        id_chemin_value_schema.style.display = 'none'
        id_chemin_value_schema_label.style.display = 'none'
        id_choix_value_schema_label.style.display = 'flex'
        id_choix_value_schema.style.display='inline'
        id_choix_value_schema_label.innerText="Partie Prenante"        
        titre_parametre_schema.innerHTML = "Choix de la partie partante"
        modifier_modal_parametres(partie_prenante_JSON,id_choix_value_schema)
    }
    else if(selection=='schema_source_de_risque'){
        id_conteneur.style.display='none'
        button_EI_IR.style.display='none'
        id_chemin_value_schema.style.display = 'none'
        id_chemin_value_schema_label.style.display = 'none'
        id_choix_value_schema_label.style.display = 'flex'
        id_choix_value_schema.style.display='inline'
        id_choix_value_schema_label.innerText="Source de Risque"
        titre_parametre_schema.innerHTML = "Choix de la source de risque"
        modifier_modal_parametres(SROV_JSON,id_choix_value_schema)
    }
    else if(selection=='schema_valeur_de_metier'){
        id_conteneur.style.display='none'
        button_EI_IR.style.display='none'
        id_chemin_value_schema.style.display = 'none'
        id_chemin_value_schema_label.style.display = 'none'
        id_choix_value_schema_label.style.display = 'flex'
        id_choix_value_schema.style.display='inline'    
        id_choix_value_schema_label.innerText="Valeur métier"       
        titre_parametre_schema.innerHTML = "Choix de la valeur métier"
        modifier_modal_parametres(valeur_metier_JSON,id_choix_value_schema)
    }
    else if(selection=='conteneur'){
        id_choix_value_schema.style.display='none'
        button_EI_IR.style.display='none'
        id_chemin_value_schema.style.display = 'none'
        id_chemin_value_schema_label.style.display = 'none'
        id_choix_value_schema_label.style.display = 'none'
        id_conteneur.style.display='inline'
        id_choix_value_schema_label.innerText="Conteneur"
        titre_parametre_schema.innerHTML = "Titre du conteneur"
        id_conteneur.innerText=''
    }
    else if(selection=='fleche'){
        recuperation_fleche()
        id_choix_value_schema.style.display='none'
        id_conteneur.style.display='inline'
        id_choix_value_schema_label.style.display='none'  
        id_chemin_value_schema.style.display = 'inline'
        id_chemin_value_schema_label.style.display = 'flex'
        button_EI_IR.style.display='flex'
        //id_conteneur.value = "EI : "
        titre_parametre_schema.innerHTML = "Titre de la relation"
    }
}

function removeOptions(selectElement) {
    var i, L = selectElement.options.length - 1;
    for(i = L; i >= 0; i--) {
       selectElement.remove(i);
    }
}

function modifier_modal_parametres(table,selector){
    for(let i=0;i<table.length;i++){
        var option = document.createElement('option')
        option.value = table[i][0]
        option.innerHTML = table[i][1]
        selector.appendChild(option)
    }  
}

function modifier_value_schema(){
    for(let i=0;i<box_schema.length;i++){
        if(box_schema[i].parentNode.parentNode.classList[2]=='selected'){
            return box_schema[i].parentNode.children[1].children
        }
    }
}

function onERButton(){
    id_conteneur.style.display='none'
    id_choix_value_schema.style.display='inline'
    id_choix_value_schema_label.style.display='inline'  
    id_choix_value_schema_label.innerText="Événement redouté" 
    modifier_modal_parametres(evenement_redoutes_JSON,id_choix_value_schema)    
  
}

function onEIButton(){
    id_choix_value_schema.style.display='none'
    id_conteneur.style.display='inline'
    id_choix_value_schema_label.style.display='none'  
    removeOptions(id_choix_value_schema);   
}


function recuperation_valeur_multiselect(){
    var table_multiselect = new Array();
    let j=0
    for(let i=0;i<id_choix_multiple_value_schema[0].length;i++){
        if(id_choix_multiple_value_schema[0][i].selected){
            table_multiselect[j] = id_choix_multiple_value_schema[0][i].innerHTML
            j++
        }
    }
    return table_multiselect;
}