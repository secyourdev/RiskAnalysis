var nom_user_parametre = document.getElementById('nom_user_parametre')
var poste_user_parametre = document.getElementById('poste_user_parametre')
var type_compte_user_parametre = document.getElementById('type_compte_user_parametre')
var email_user_parametre = document.getElementById('email_user_parametre')
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
    },
    error: function (erreur) {
        alert('ERROR :' + erreur);
    }
});
