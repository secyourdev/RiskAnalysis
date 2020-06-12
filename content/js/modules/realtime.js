/*------------------------------- VARIABLES ----------------------------------*/
var nom_etude = document.getElementById('nom_etude');
var objectif_atteindre = document.getElementById('objectif_atteindre');
var cadre_temporel = document.getElementById('cadre_temporel');
var nom_acteur = document.getElementById('nom_acteur');
var prenom_acteur = document.getElementById('prenom_acteur');
var poste_acteur = document.getElementById('poste_acteur');
var table = document.getElementById('editable_table')
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

var table_cells_length = table.rows[0].cells.length; 
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

/*------------------------------- FONCTIONS --------------------------------*/
function verify_input(value,regex,input){
    if(regex.test(value)) input.style.borderBottom="2px solid #4AD991";
    else if(value.length==0) input.style.borderBottom="1px solid #64789A";
    else input.style.borderBottom="2px solid #FF6565";
}

function verify_textarea(value,regex,input){
    if(regex.test(value)) input.style.border="2px solid #4AD991";
    else if(value.length==0) input.style.border="1px solid #64789A";
    else input.style.border="2px solid #FF6565";
}

function verify_textarea_2(value,regex,bool,input,save){
    if(regex.test(value)){
        input.style.border="2px solid #4AD991";
        bool = true;
        save.disabled = false
    }
    else if(value.length==0){
        input.style.border="1px solid #64789A";
        bool = false;
        save.disabled = true
    }
    else{
        input.style.border="2px solid #FF6565";
        bool = false;
        save.disabled = true
    }
    return bool
}

function activate_label(value,label){
    if(value.length!=0) label.style.display='inline'
    else label.style.display='none'
}

function tableau_verification(value_test){
    var table = document.getElementById('editable_table')
    var table_cells_length = table.rows[0].cells.length; 
    var bool =new Array()
    var bool_final=true;
    var regex = /^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/
        for(let j=1;j<table_cells_length-1;j++){
            bool[j] = verify_textarea_2(table.rows[value_test].cells[j].children[1].value,regex,bool,table.rows[value_test].cells[j].children[1],save_button[value_test-1])
            table.rows[value_test].cells[j].children[1].addEventListener('keyup',function(event){
                bool[j]= verify_textarea_2(table.rows[value_test].cells[j].children[1].value,regex,bool,table.rows[value_test].cells[j].children[1],save_button[value_test-1])
            })
        }
        for(let i=1;i<table_cells_length-1;i++){
            bool_final = bool_final&&bool[i]

        }
    return bool_final
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function acteur_verification(){
    if(bool_nom_acteur&&bool_prenom_acteur&&bool_poste_acteur) valider_acteur.disabled = false
    else valider_acteur.disabled = true
}