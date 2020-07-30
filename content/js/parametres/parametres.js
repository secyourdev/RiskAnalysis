var nom_user_parametre = document.getElementById('nom_user_parametre')
var poste_user_parametre = document.getElementById('poste_user_parametre')
var type_compte_user_parametre = document.getElementById('type_compte_user_parametre')
var email_user_parametre = document.getElementById('email_user_parametre')

var nom = document.getElementById('nom')
var prenom = document.getElementById('prenom')
var poste = document.getElementById('poste')
var email = document.getElementById('email')

var label_nom = document.getElementById('nom').previousSibling.previousSibling
var label_prenom = document.getElementById('prenom').previousSibling.previousSibling
var label_poste = document.getElementById('poste').previousSibling.previousSibling
var label_email = document.getElementById('email').previousSibling.previousSibling

var email_modif_mdp = document.getElementById('email_modif_mdp')
var ancien_mdp = document.getElementById('ancien_mdp')
var nouveau_mdp = document.getElementById('nouveau_mdp')
var confirmation = document.getElementById('confirmation_nouveau_mdp')

var label_email_modif_mdp = document.getElementById('email_modif_mdp').previousSibling.previousSibling
var label_ancien_mdp = document.getElementById('ancien_mdp').previousSibling.previousSibling
var label_nouveau_mdp = document.getElementById('nouveau_mdp').previousSibling.previousSibling
var label_confirmation = document.getElementById('confirmation_nouveau_mdp').previousSibling.previousSibling

var regex_nom = /^[a-zA-Z0-9éèàêâùïüëç\s-./:,'"]{0,100}$/

var lenght_user
/*------------------------- CHARGEMENT DES INFORMATIONS UTILISATEUR  --------------------*/
$.ajax({
    url: 'content/php/parametres/selection_user.php',
    type: 'POST',
    dataType: 'html',
    success: function (resultat) {
        var user_JSON = JSON.parse(resultat);
        lenght_user = user_JSON.length;
        nom_user_parametre.innerText=user_JSON[0][0]+' '+ user_JSON[0][1]
        poste_user_parametre.innerText=user_JSON[0][2]
        type_compte_user_parametre.innerText=user_JSON[0][4]
        email_user_parametre.innerText=user_JSON[0][3]

        nom.value=user_JSON[0][0]
        prenom.value=user_JSON[0][1]
        poste.value=user_JSON[0][2]
        email.value=user_JSON[0][3]
        email_modif_mdp.value=user_JSON[0][3]
    },
    error: function (erreur) {
        alert('ERROR :' + erreur);
    }
});

/*------------------------------ LABELS CACHES ------------------------------*/
// label_nom.style.display="none"
// label_prenom.style.display="none"
// label.style.display="none"
// label_email.style.display="none"
label_email_modif_mdp.style.display="none"
label_ancien_mdp.style.display="none"
label_nouveau_mdp.style.display="none"
label_confirmation.style.display="none"

/*----------------------- ENREGISTREMENT DES COOKIES ------------------------*/
nom.addEventListener('keyup',function(event){
    verify_input(nom.value,regex_nom,nom)
    activate_label(nom.value,label_nom)
}) 

prenom.addEventListener('keyup',function(event){
    verify_input(prenom.value,regex_nom,prenom)
    activate_label(prenom.value,label_prenom)
})

poste.addEventListener('keyup',function(event){
    verify_input(poste.value,regex_nom,poste)
    activate_label(poste.value,label_poste)
})

email.addEventListener('keyup',function(event){
    verify_input(email.value,regex_nom,email)
    activate_label(email.value,label_email)
})

email_modif_mdp.addEventListener('keyup',function(event){
    verify_input(email_modif_mdp.value,regex_nom,email_modif_mdp)
    activate_label(email_modif_mdp.value,label_email_modif_mdp)
})

ancien_mdp.addEventListener('keyup',function(event){
    verify_input(ancien_mdp.value,regex_nom,ancien_mdp)
    activate_label(ancien_mdp.value,label_ancien_mdp)
})

nouveau_mdp.addEventListener('keyup',function(event){
    verify_input(nouveau_mdp.value,regex_nom,nouveau_mdp)
    activate_label(nouveau_mdp.value,label_nouveau_mdp)
})

confirmation.addEventListener('keyup',function(event){
    verify_input(confirmation.value,regex_nom,confirmation)
    activate_label(confirmation.value,label_confirmation)
})