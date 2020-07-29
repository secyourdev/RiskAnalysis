/* ----------------------------------- VARIABLES --------------------------------- */
var lenght_projet;
var lenght_grp_user;
var lenght_user;
var project_card = document.getElementById('project_card')
var grp_user_card = document.getElementById('grp_user_card')
var apps_card = document.getElementById('apps_card')
var bdd_card = document.getElementById('bdd_card')

var tableau_de_bord_projet = document.getElementById('tableau_de_bord_projet')
var tableau_de_bord_grp_user = document.getElementById('tableau_de_bord_grp_user')
var tableau_de_bord_app = document.getElementById('tableau_de_bord_app')
var tableau_de_bord_bdd = document.getElementById('tableau_de_bord_bdd')

var projets = document.getElementById('projets')
var button_add_user_in_grp = document.getElementById('button_add_user_in_grp')
var ajouter_user = document.getElementById('ajouter_user')

var email_modif_mdp = document.getElementById('email_modif_mdp')
var reinitialiser_mdp = document.getElementsByClassName('reinitialiser_mdp')
var generer_mdp = document.getElementsByClassName('generer_mdp')

var nom_etude = document.getElementById('nom_etude');
var description_etude = document.getElementById('description_etude');
var label_nom_etude = document.getElementById('nom_etude').previousSibling.previousSibling

var nom_groupe_utilisateur = document.getElementById('nom_grp_user');
var label_groupe_utilisateur = document.getElementById('nom_grp_user').previousSibling.previousSibling

var nom_utilisateur = document.getElementById('nom_utilisateur');
var prenom_utilisateur = document.getElementById('prenom_utilisateur');
var poste_utilisateur = document.getElementById('poste_utilisateur');
var email_utilisateur = document.getElementById('email_utilisateur');

var label_nom_utilisateur =document.getElementById('nom_utilisateur').previousSibling.previousSibling
var label_prenom_utilisateur = document.getElementById('prenom_utilisateur').previousSibling.previousSibling
var label_poste_utilisateur = document.getElementById('poste_utilisateur').previousSibling.previousSibling
var label_email_utilisateur = document.getElementById('email_utilisateur').previousSibling.previousSibling

var lenght_reinitialiser_mdp = reinitialiser_mdp.length;

var regex_nom = /^[a-zA-Z0-9éèàêâùïüëç\s-./:,'"]{1,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëç\s-.:,'"]{1,1000}$/
var regex_email = /^[a-zA-Z0-9éèàêâùïüëç\s-./:,'"@]{1,100}$/

button_add_user_in_grp.style.display='none'
grp_user_card.style.display="none"
apps_card.style.display="none"
bdd_card.style.display="none"
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function() {
    $('#editable_table').Tabledit({
        url: 'content/php/accueil/modification_grp_user.php',
        columns: {
            identifier: [0, "id_grp_utilisateur"],
            editable: [[1, "nom_grp_utilisateur"]]
        },
        restoreButton: false,
        hideIdentifier: false,
        onSuccess: function(data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_grp_utilisateur).remove();
            }
        }
    });
});

$(document).ready(function(){  
    $('#table_app_user').Tabledit({
     url:'content/php/accueil/modification_app_utilisateur.php',
     columns:{
      identifier:[0, "id_utilisateur"],
      editable:[[1, 'nom'], [2, 'prenom'], [3, 'poste'], [4, 'email'], [5, 'type_compte','{"Administrateur Logiciel":"Administrateur Logiciel","Chef de Projet":"Chef de Projet","Utilisateur":"Utilisateur"}']]
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
OURJQUERYFN.setFilterTable("#rechercher_grp_user","#editable_table tbody tr")

setSortTable('tableau_user');
OURJQUERYFN.setFilterTable("#rechercher_user","#tableau_user tbody tr")

setSortTable('table_app_user');
OURJQUERYFN.setFilterTable("#rechercher_app_utilisateur","#table_app_user tbody tr")
/*----------------------------- CHARGEMENT DES ONGLETS ----------------------------*/
switch (sessionStorage.getItem('button')){
    case 'project_card':
        chargement_onglet(project_card,grp_user_card,apps_card,bdd_card);
        break;
    case 'grp_user_card':
        chargement_onglet(grp_user_card,project_card,apps_card,bdd_card);
        break;
    case 'apps_card':
        chargement_onglet(apps_card,project_card,grp_user_card,bdd_card);
        break;
    case 'bdd_card':
        chargement_onglet(bdd_card,project_card,grp_user_card,apps_card);
        break;
    default :
        chargement_onglet(project_card,grp_user_card,apps_card,bdd_card);
}

selection_onglet(project_card,grp_user_card,apps_card,bdd_card,tableau_de_bord_projet,'project_card')
selection_onglet(grp_user_card,project_card,apps_card,bdd_card,tableau_de_bord_grp_user,'grp_user_card')
selection_onglet(apps_card,project_card,grp_user_card,bdd_card,tableau_de_bord_app,'apps_card')
selection_onglet(bdd_card,project_card,grp_user_card,apps_card,tableau_de_bord_bdd,'bdd_card')

function selection_onglet(onglet1,onglet2,onglet3,onglet4,button,cookies_value){
    button.addEventListener('click',function(){
        sessionStorage.setItem('button',cookies_value);
        chargement_onglet(onglet1,onglet2,onglet3,onglet4)
    })
}

function chargement_onglet(onglet1,onglet2,onglet3,onglet4){
        onglet1.style.display='inherit'
        onglet2.style.display="none"
        onglet3.style.display="none"
        onglet4.style.display="none"
}
/*------------------------ CHARGEMENT DES GRP UTILISATEURS  ------------------------*/
$.ajax({
    url: 'content/php/accueil/selection_json_grp_user.php',
    type: 'POST',
    dataType: 'html',
    success: function (resultat) {
        var grp_user_JSON = JSON.parse(resultat);
        lenght_grp_user = grp_user_JSON.length;
        grp_user = lenght_grp_user;
    },
    error: function (erreur) {
        alert('ERROR :' + erreur);
    }
});

/*-------------------------- CHARGEMENT DES UTILISATEURS  -------------------------*/
$.ajax({
    url: 'content/php/accueil/selection_json_user.php',
    type: 'POST',
    dataType: 'html',
    success: function (resultat) {
        var user_JSON = JSON.parse(resultat);
        lenght_user = user_JSON.length;
        app = lenght_user;
    },
    error: function (erreur) {
        alert('ERROR :' + erreur);
    }
});

/*----------------------------- CHARGEMENT DES PROJETS ----------------------------*/
$.ajax({
    url: 'content/php/accueil/selection_projet_admin.php',
    type: 'POST',
    dataType: 'html',
    success: function (resultat) {
        var projet_JSON = JSON.parse(resultat);
        lenght_projet = projet_JSON.length;
        for (let i = lenght_projet-1; i >= 0; i--) {
            var projets = document.getElementById('projets');

            var div1 = document.createElement('div');
            div1.setAttribute('class', 'col-xl-6 col-lg-6')

            var div2 = document.createElement('div');
            div2.setAttribute('class', 'card shadow mb-4')

            var form = document.createElement('form')
            form.setAttribute('method', 'post')
            form.setAttribute('action', 'content/php/accueil/search_project.php')

            var fieldset = document.createElement('fieldset')

            var input_text = document.createElement('input')
            input_text.setAttribute('type', 'hidden')
            input_text.setAttribute('id', 'id_projet' + i)
            input_text.setAttribute('name', 'id_projet')
            input_text.value = projet_JSON[i][0]

            var div_input = document.createElement('div')
            div_input.setAttribute('class', 'text-center')

            var input = document.createElement('input')
            input.setAttribute('type', 'submit')
            input.setAttribute('name', 'search_project')
            input.setAttribute('value', 'Ouvrir')
            input.setAttribute('class', 'btn perso_btn_primary perso_btn_spacing shadow-none')

            var a = document.createElement('a');
            a.setAttribute('href', 'content/php/accueil/search_project.php')

            var div3 = document.createElement('div')
            div3.setAttribute('class',
                'card-header d-flex flex-row align-items-center justify-content-between')

            var h6 = document.createElement('h6')
            h6.setAttribute('id', projet_JSON[i][0])
            h6.setAttribute('class', 'm-0')
            h6.innerHTML = 'Projet #' + projet_JSON[i][0] + " : " + projet_JSON[i][1]

            var div_modif = document.createElement('div')
            div_modif.setAttribute('class', 'modification')

            var pen = document.createElement('i')
            pen.setAttribute('class','modif_icon crayon fas fa-pen')
            pen.setAttribute('data-toggle','modal')
            pen.setAttribute('data-target','#modif_projet')

            var trash = document.createElement('i')
            trash.setAttribute('class','suppr_icon poubelle fas fa-trash-alt')
            trash.setAttribute('data-toggle','modal')
            trash.setAttribute('data-target','#suppr_projet')

            var div4 = document.createElement('div')
            div4.setAttribute('class', 'card-body')

            var label = document.createElement('label')
            label.innerHTML = projet_JSON[i][2]

            var label2 = document.createElement('label')
            if(projet_JSON[i][3]==null)
                label2.innerHTML = 'Date de fin du projet : A définir'
            else 
                label2.innerHTML = 'Date de fin du projet : ' + projet_JSON[i][3]

            var br = document.createElement('br')

            div4.appendChild(label)
            div4.appendChild(br)
            div4.appendChild(label2)
            div3.appendChild(h6)
            div_modif.appendChild(pen)
            div_modif.appendChild(trash)
            div3.appendChild(div_modif)
            form.appendChild(fieldset)
            fieldset.appendChild(div3)
            fieldset.appendChild(div4)
            div4.appendChild(input_text)
            div_input.appendChild(input)
            div4.appendChild(div_input)
            div2.appendChild(form)
            div1.appendChild(div2)
            projets.appendChild(div1)
          
            prj = lenght_projet;  
            grp_user = lenght_grp_user; 
            app = lenght_user;
            sleep(100).then(() => {compteur_anim();});
            modification_projet();
            suppression_projet();
        }
    },
    error: function (erreur) {
        alert('ERROR :' + erreur);
    }
});
/*----------------------------------- FONCTIONS -----------------------------------*/
function compteur_anim() {
    $('#prj.compteur b').animate({
        prj: prj,
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        },
    });
    $('#grp_user.compteur b').animate({
        grp_user: grp_user,
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        },
    });
    $('#app.compteur b').animate({
        app: app,
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        },
    });
    $('#bdd.compteur b').animate({
        bdd: bdd,
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        },
    });
};


ajouter_user.addEventListener('click', (event) => {
    $.ajax({
      url: 'content/php/accueil/ajout_user.php',
      type: 'POST',
      data: {
            id_utilisateur: SelectUser.value,
            nom_grp_utilisateur: nomgrpuser.value
      },
      success: function (data) {
        $('.modal-content').html('');
        $('#ajout_user').on('hidden.bs.modal', function () {
        });
        location.reload();
        $('#ajout_user').modal('hide');
      }
    })
  });


/*-------------------------- REINISTIALISER LE MOT DE PASSE ------------------------*/  
for(let i=0;i<lenght_reinitialiser_mdp;i++){
  reinitialiser_mdp[i].addEventListener('click',function(){

    $.ajax({
        url: 'content/php/accueil/selection_user_modif_mdp.php',
        type: 'POST',
        data: {
              id_utilisateur: reinitialiser_mdp[i].parentNode.parentNode.id
        },
        dataType: 'html',
        success: function (resultat) {
            var user_JSON = JSON.parse(resultat);
            email_modif_mdp.value = user_JSON[0][0]
        }
      })
  });
}

/*----------------------------- GENERER LE MOT DE PASSE --------------------------*/  
for(let i=0;i<lenght_reinitialiser_mdp;i++){
    generer_mdp[i].addEventListener('click',function(){
    console.log(generer_mdp[i].parentNode.parentNode.id);

    $.ajax({
        url: 'content/php/accueil/generer_mdp.php',
        type: 'POST',
        data: {
              id_utilisateur: generer_mdp[i].parentNode.parentNode.id
        },
        success: function (data) {
            location.reload();
        }
      })
  });
}
/*------------------------- MODIFICATION & SUPPRESSION PROJET ----------------------*/
function modification_projet(){
    var modif_icon = document.getElementsByClassName('modif_icon');
    var lenght_modif_icon = modif_icon.length;
    var id_etude_modif = document.getElementById('id_etude_modif')
    var nom_etude_modif = document.getElementById('nom_etude_modif')
    var description_etude_modif = document.getElementById('description_etude_modif')
    var chef_de_projet_modif = document.getElementById('chef_de_projet_modif')
    var id_grp_utilisateur_modif = document.getElementById('id_grp_utilisateur_modif')
    for(let i=0;i<lenght_modif_icon;i++){
        modif_icon[i].addEventListener('click',function(){
            $.ajax({
                url: 'content/php/accueil/selection_projet_admin_modification_icon.php',
                type: 'POST',
                data: {
                      id_projet: modif_icon[i].parentNode.previousSibling.id
                },
                dataType: 'html',
                success: function (resultat) {
                    var projet_JSON = JSON.parse(resultat);
                    console.log(projet_JSON)
                    id_etude_modif.value = projet_JSON[0][0]
                    nom_etude_modif.value = projet_JSON[0][1]
                    description_etude_modif.value = projet_JSON[0][2]
                    chef_de_projet_modif.value = projet_JSON[0][3]
                    id_grp_utilisateur_modif.value = projet_JSON[0][4]
                }
              })
        })    
    }
}

function suppression_projet(){
    var suppr_icon = document.getElementsByClassName('suppr_icon')
    var lenght_suppr_icon = suppr_icon.length;
    var id_etude_suppr = document.getElementById('id_etude_suppr')
    var nom_etude_suppr = document.getElementById('nom_etude_suppr')
    for(let i=0;i<lenght_suppr_icon;i++){
        suppr_icon[i].addEventListener('click',function(){
            $.ajax({
                url: 'content/php/accueil/selection_projet_admin_suppression_icon.php',
                type: 'POST',
                data: {
                      id_projet: suppr_icon[i].parentNode.previousSibling.id
                },
                dataType: 'html',
                success: function (resultat) {
                    var projet_JSON = JSON.parse(resultat);
                    id_etude_suppr.value = projet_JSON[0][0]
                    nom_etude_suppr.value = projet_JSON[0][1]
                }
              })
        })
    }
}

/*------------------------------ LABELS CACHES ------------------------------*/
label_nom_etude.style.display="none"
label_groupe_utilisateur.display="none"
label_prenom_utilisateur.display="none"
label_nom_utilisateur.display="none"
label_poste_utilisateur.display="none"
label_email_utilisateurdisplay="none"

/*----------------------- ENREGISTREMENT DES COOKIES ------------------------*/
nom_etude.addEventListener('keyup',function(event){
    verify_input(nom_etude.value,regex_nom,nom_etude)
    activate_label(nom_etude.value,label_nom_etude)
}) 

description_etude.addEventListener('keyup',function(event){
    verify_textarea(description_etude.value,regex_description,description_etude)
})

nom_groupe_utilisateur.addEventListener('keyup',function(event){
    verify_input(nom_groupe_utilisateur.value,regex_nom,nom_groupe_utilisateur)
    activate_label(nom_groupe_utilisateur.value,label_groupe_utilisateur)
})

nom_utilisateur.addEventListener('keyup',function(event){
    verify_input(nom_utilisateur.value,regex_nom,nom_utilisateur)
    activate_label(nom_utilisateur.value,label_nom_utilisateur)
})

prenom_utilisateur.addEventListener('keyup',function(event){
    verify_input(prenom_utilisateur.value,regex_nom,prenom_utilisateur)
    activate_label(prenom_utilisateur.value,label_prenom_utilisateur)
})

poste_utilisateur.addEventListener('keyup',function(event){
    verify_input(poste_utilisateur.value,regex_nom,poste_utilisateur)
    activate_label(poste_utilisateur.value,label_poste_utilisateur)
})

email_utilisateur.addEventListener('keyup',function(event){
    verify_input(email_utilisateur.value,regex_email,email_utilisateur)
    activate_label(email_utilisateur.value,label_email_utilisateur)
})

