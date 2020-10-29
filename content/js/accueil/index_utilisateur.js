/* ----------------------------------- VARIABLES --------------------------------- */
var lenght_projet;
var project_card = document.getElementById('project_card')

var tableau_de_bord_projet = document.getElementById('tableau_de_bord_projet')
var projets = document.getElementById('projets')
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
            h6.innerHTML = 'Projet #' + projet_JSON[i][11] + " : " + projet_JSON[i][1]

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
};