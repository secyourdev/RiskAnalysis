/*------------------------------- VARIABLES ----------------------------------*/
var nom_etude = document.getElementById('nom_etude');
var objectif_atteindre = document.getElementById('objectif_atteindre');
var cadre_temporel = document.getElementById('cadre_temporel');
var nom_acteur = document.getElementById('nom_acteur');
var prenom_acteur = document.getElementById('prenom_acteur');
var poste_acteur = document.getElementById('poste_acteur');
var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var valider_acteur = document.getElementsByName('valider')[0]
var label_nom_etude = document.getElementById('nom_etude').previousSibling.previousSibling
var label_cadre_temporel = document.getElementById('cadre_temporel').previousSibling.previousSibling
var label_nom_acteur = document.getElementById('nom_acteur').previousSibling.previousSibling
var label_prenom_acteur = document.getElementById('prenom_acteur').previousSibling.previousSibling
var label_poste_acteur = document.getElementById('poste_acteur').previousSibling.previousSibling
var raci = document.getElementById('raci')

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

/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function(){  
    $('#editable_table').Tabledit({
     url:'content/php/atelier1a/modification.php',
     columns:{
      identifier:[0, "id_utilisateur"],
      editable:[[1, 'nom'], [2, 'prenom'], [3, 'poste']]
     },
     restoreButton:false,
     onSuccess:function(data, textStatus, jqXHR)
     {
      if(data.action == 'delete')
      {
       $('#'+data.id_utilisateur).remove();
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
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'4'+')')
    }
});
/*-------------------------- INITIALISATION RACI --------------------------- */
var nombre_atelier = raci.rows.length
for(let i=1;i<nombre_atelier;i++){
    var nombre_acteur = raci.rows[0].children.length-1
    while(nombre_acteur!=0){
        var choix_raci = document.createElement("td")
        var select = document.createElement("select")
        var option_R = document.createElement("option")
        var option_A = document.createElement("option")
        var option_C = document.createElement("option")
        var option_I = document.createElement("option")

        select.setAttribute("class","form-control width_RACI")
        option_R.innerHTML = "Réalisation"; option_R.setAttribute("valeur","Réalisation");
        option_A.innerHTML = "Approbation"; option_A.setAttribute("valeur","Approbation");
        option_C.innerHTML = "Consultation"; option_C.setAttribute("valeur","Consultation");
        option_I.innerHTML = "Information"; option_I.setAttribute("valeur","Information"); option_I.setAttribute("selected","");


        select.appendChild(option_R)
        select.appendChild(option_A)
        select.appendChild(option_C)
        select.appendChild(option_I)
        choix_raci.appendChild(select)
        raci.rows[i].appendChild(choix_raci)
        nombre_acteur--
    }
}
/*----------------------- RECUPERATION VALEURS RACI ------------------------- */


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
