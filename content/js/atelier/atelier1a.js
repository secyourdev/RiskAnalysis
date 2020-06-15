/*------------------------------- VARIABLES ----------------------------------*/
var nom_etude = document.getElementById('nom_etude');
var objectif_atteindre = document.getElementById('objectif_atteindre');
var cadre_temporel = document.getElementById('cadre_temporel');
var nom_acteur = document.getElementById('nom_acteur');
var prenom_acteur = document.getElementById('prenom_acteur');
var poste_acteur = document.getElementById('poste_acteur');
var table_1a = document.getElementById('editable_table')
var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var valider_acteur = document.getElementsByName('valider')[0]
var label_nom_etude = document.getElementById('nom_etude').previousSibling.previousSibling
var label_cadre_temporel = document.getElementById('cadre_temporel').previousSibling.previousSibling
var label_nom_acteur = document.getElementById('nom_acteur').previousSibling.previousSibling
var label_prenom_acteur = document.getElementById('prenom_acteur').previousSibling.previousSibling
var label_poste_acteur = document.getElementById('poste_acteur').previousSibling.previousSibling

var bool_nom_etude = false
var bool_objectif_atteindre = false
var bool_cadre_temporel = false
var bool_nom_acteur = false
var bool_prenom_acteur = false
var bool_poste_acteur = false


var regex_nom_etude = /^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/
var regex_objectif_atteindre = /^[a-zA-Z0-9éèàêâùïüëç\s-.]{1,1000}$/
var regex_cadre_temporel = /^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/
var regex_nom_acteur = /^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/
var regex_prenom_acteur = /^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/
var regex_poste_acteur = /^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/

var table_1a_cells_length = table_1a.rows[0].cells.length; 
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function(){  
    $('#editable_table').Tabledit({
     url:'content/php/atelier1a/modification.php',
     columns:{
      identifier:[0, "id_personne"],
      editable:[[1, 'nom'], [2, 'prenom'], [3, 'poste']]
     },
     restoreButton:false,
     onSuccess:function(data, textStatus, jqXHR)
     {
      if(data.action == 'delete')
      {
       $('#'+data.id_personne).remove();
      }
     }
    });
});
/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_acteur","#editable_table tbody tr")
/*------------------------------ LABELS CACHES ------------------------------*/
label_nom_etude.style.display="none"
label_cadre_temporel.style.display="none"
label_nom_acteur.style.display="none"
label_prenom_acteur.style.display="none"
label_poste_acteur.style.display="none"
/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<button.length;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+')')
    }
});
/*------------------------- CHARGEMENT DES COOKIES ---------------------------*/

nom_etude.value = sessionStorage.getItem('nom_etude');
objectif_atteindre.value = sessionStorage.getItem('objectif_atteindre');
cadre_temporel.value = sessionStorage.getItem('cadre_temporel');

acteur_verification()
verify_input(nom_etude.value,regex_nom_etude,nom_etude)
verify_textarea(objectif_atteindre.value,regex_objectif_atteindre,objectif_atteindre)
verify_input(cadre_temporel.value,regex_cadre_temporel,cadre_temporel)
activate_label(nom_etude.value,label_nom_etude)
activate_label(cadre_temporel.value,label_cadre_temporel)

/*----------------------- ENREGISTREMENT DES COOKIES ------------------------*/
nom_etude.addEventListener('keyup',function(event){
    sessionStorage.setItem('nom_etude',nom_etude.value);
    verify_input(nom_etude.value,regex_nom_etude,nom_etude)
    activate_label(nom_etude.value,label_nom_etude)
})

objectif_atteindre.addEventListener('keyup',function(event){
    sessionStorage.setItem('objectif_atteindre',objectif_atteindre.value);
    verify_textarea(objectif_atteindre.value,regex_objectif_atteindre,objectif_atteindre)
})

cadre_temporel.addEventListener('keyup',function(event){
    sessionStorage.setItem('cadre_temporel',cadre_temporel.value);
    verify_input(cadre_temporel.value,regex_cadre_temporel,cadre_temporel)
    activate_label(cadre_temporel.value,label_cadre_temporel)
})

nom_acteur.addEventListener('keyup',function(event){
    bool_nom_acteur = regex_nom_acteur.test(nom_acteur.value)
    verify_input(nom_acteur.value,regex_nom_acteur,nom_acteur)
    acteur_verification()
    activate_label(nom_acteur.value,label_nom_acteur)
})

prenom_acteur.addEventListener('keyup',function(event){
    bool_prenom_acteur = regex_prenom_acteur.test(prenom_acteur.value)
    verify_input(prenom_acteur.value,regex_prenom_acteur,prenom_acteur)
    acteur_verification()
    activate_label(prenom_acteur.value,label_prenom_acteur)
})

poste_acteur.addEventListener('keyup',function(event){
    bool_poste_acteur = regex_poste_acteur.test(poste_acteur.value)
    verify_input(poste_acteur.value,regex_poste_acteur,poste_acteur)
    acteur_verification()
    activate_label(poste_acteur.value,label_poste_acteur)
})
