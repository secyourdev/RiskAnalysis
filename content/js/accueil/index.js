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
    url: 'content/php/accueil/selection_projet.php',
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
            h6.setAttribute('class', 'm-0')
            h6.innerHTML = 'Projet #' + projet_JSON[i][0] + " : " + projet_JSON[i][1]

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

