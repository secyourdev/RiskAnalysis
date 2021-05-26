/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var nom_etude = document.getElementById('nom_etude');
var objectif_atteindre = document.getElementById('objectif_atteindre');
var cadre_temporel = document.getElementById('cadre_temporel');
var cadre_temporel_etape_2 = document.getElementById('cadre_temporel_etape_2');
var cadre_temporel_etape_3 = document.getElementById('cadre_temporel_etape_3');
var cadre_temporel_etape_4 = document.getElementById('cadre_temporel_etape_4');
var cadre_temporel_etape_5 = document.getElementById('cadre_temporel_etape_5');
var confidentialite = document.getElementById('confidentialite');
var cycle_strategique = document.getElementById('cycle_strategique');
var cycle_operationnel = document.getElementById('cycle_operationnel');

var valider_acteur = document.getElementsByName('valider')[0]

var label_nom_etude = document.getElementById('nom_etude').previousSibling.previousSibling
var label_cadre_temporel = document.getElementById('cadre_temporel').previousSibling.previousSibling
var label_cadre_temporel_etape_2 = document.getElementById('cadre_temporel_etape_2').previousSibling.previousSibling
var label_cadre_temporel_etape_3 = document.getElementById('cadre_temporel_etape_3').previousSibling.previousSibling
var label_cadre_temporel_etape_4 = document.getElementById('cadre_temporel_etape_4').previousSibling.previousSibling
var label_cadre_temporel_etape_5 = document.getElementById('cadre_temporel_etape_5').previousSibling.previousSibling
var label_confidentialite = document.getElementById('confidentialite').previousSibling.previousSibling
var label_cycle_strategique = document.getElementById('cycle_strategique').previousSibling.previousSibling
var label_cycle_operationnel = document.getElementById('cycle_operationnel').previousSibling.previousSibling


var raci = document.getElementById('raci')
var acteur_id_raci = document.getElementById('acteur_id_raci')
var respo_acceptation_risque = document.getElementById('respo_acceptation_risque')
var find_acteur_id;
var find_atelier_num;
var find_raci_value;

var nombre_atelier = raci.rows.length

var regex_nom_etude = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{1,100}$/
var regex_description_etude = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{1,100}$/
var regex_objectif_atteindre = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{1,100}$/
var regex_cadre_temporel = /^[0-9\s-]{0,100}$/
var regex_cycle = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{1,100}$/
/*------------------------------- SIDEBAR ----------------------------------*/
show_sub_content()
sidebarToggleTop.addEventListener('click', show_sub_content,false);
sidebarToggle.addEventListener('click',show_sub_content,false);
window.addEventListener('resize', show_sub_content, false);
function show_sub_content(){
    var Atelier1 = document.getElementById('Atelier1');
    if(!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(min-width: 768px)").matches)){
        Atelier1.classList.add('show')
    }
}
/*------------------------- SELECTION UTILISATEUR --------------------------*/
var user_1a = document.getElementById('user_1a')
var ajouter_user = document.getElementById('ajouter_user')

ajouter_user.addEventListener('click', (event) => {
    $.ajax({
      url: 'content/php/atelier1a/ajout.php',
      type: 'POST',
      data: {
            id_utilisateur: user_1a.value,
      },
      success: function (data) {
        location.reload();
      }
    })
  });

/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function(){  
    $('#editable_table').Tabledit({
     url:'content/php/atelier1a/modification.php',
     deleteButton: true,
     editButton:false,
     columns:{
      identifier:[0, "id_utilisateur"],
      editable:[]
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

for(let i=3;i<nombre_atelier;i++){
    var nombre_acteur = raci.rows[0].children.length-1
    while(nombre_acteur!=0){
        var choix_raci = document.createElement("td")
        var select = document.createElement("select")
        var option_R = document.createElement("option")
        var option_A = document.createElement("option")
        var option_C = document.createElement("option")
        var option_I = document.createElement("option")

        select.setAttribute("class","form-control width_select")
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

var nombre_acteur = raci.rows[0].children.length-1
    while(nombre_acteur!=0){
        var choix_raci = document.createElement("td")
        var select = document.createElement("select")
        var option_null = document.createElement("option")
        var option_R = document.createElement("option")
        var option_A = document.createElement("option")
        var option_C = document.createElement("option")
        var option_I = document.createElement("option")        

        select.setAttribute("class","form-control width_select")
        option_null.innerHTML = "..."; option_I.setAttribute("valeur",""); option_null.setAttribute("selected","");
        option_R.innerHTML = "Réalisation"; option_R.setAttribute("valeur","Réalisation");
        option_A.innerHTML = "Approbation"; option_A.setAttribute("valeur","Approbation");
        option_C.innerHTML = "Consultation"; option_C.setAttribute("valeur","Consultation");
        option_I.innerHTML = "Information"; option_I.setAttribute("valeur","Information"); 

        select.appendChild(option_null)
        select.appendChild(option_R)
        select.appendChild(option_A)
        select.appendChild(option_C)
        select.appendChild(option_I)
        choix_raci.appendChild(select)
        raci.rows[2].appendChild(choix_raci)
        nombre_acteur--
    }


/*----------------- RECUPERATION & MODIFICATION VALEURS RACI ---------------- */
acteur_id_raci.style.display ='none'
get_database_raci()
update_database_raci()
update_full_raci()
/*------------------------ RECUPERATION & MODIFICATION ----------------------*/
get_database_project_info()
/*----------------------- -- VERIFICATION DES CHAMPS -- ------------------------*/
nom_etude.addEventListener('keyup',function(event){
    verify_input(nom_etude.value,regex_nom_etude,nom_etude)
    activate_label(nom_etude.value,label_nom_etude)
    update_database_nom_etude(nom_etude.value)
}) 

objectif_atteindre.addEventListener('keyup',function(event){
    verify_textarea(objectif_atteindre.value,regex_objectif_atteindre,objectif_atteindre)
    update_database_objectif_atteindre(objectif_atteindre.value)
})

cadre_temporel.addEventListener('change',function(event){
    verify_input(cadre_temporel.value,regex_cadre_temporel,cadre_temporel)
    activate_label(cadre_temporel.value,label_cadre_temporel)
    update_database_cadre_temporel(cadre_temporel.value)
})

cadre_temporel_etape_2.addEventListener('change',function(event){
    verify_input(cadre_temporel_etape_2.value,regex_cadre_temporel,cadre_temporel_etape_2)
    activate_label(cadre_temporel_etape_2.value,label_cadre_temporel_etape_2)
    update_database_cadre_temporel_etape_2(cadre_temporel_etape_2.value)
})

cadre_temporel_etape_3.addEventListener('change',function(event){
    verify_input(cadre_temporel_etape_3.value,regex_cadre_temporel,cadre_temporel_etape_3)
    activate_label(cadre_temporel_etape_3.value,label_cadre_temporel_etape_3)
    update_database_cadre_temporel_etape_3(cadre_temporel_etape_3.value)
})

cadre_temporel_etape_4.addEventListener('change',function(event){
    verify_input(cadre_temporel_etape_4.value,regex_cadre_temporel,cadre_temporel_etape_4)
    activate_label(cadre_temporel_etape_4.value,label_cadre_temporel_etape_4)
    update_database_cadre_temporel_etape_4(cadre_temporel_etape_4.value)
})

cadre_temporel_etape_5.addEventListener('change',function(event){
    verify_input(cadre_temporel_etape_5.value,regex_cadre_temporel,cadre_temporel_etape_5)
    activate_label(cadre_temporel_etape_5.value,label_cadre_temporel_etape_5)
    update_database_cadre_temporel_etape_5(cadre_temporel_etape_5.value)
})

cycle_strategique.addEventListener('keyup',function(event){
    verify_input(cycle_strategique.value,regex_cycle,cycle_strategique)
    update_database_cycle_strategique(cycle_strategique.value)
})

cycle_operationnel.addEventListener('keyup',function(event){
    verify_input(cycle_operationnel.value,regex_cycle,cycle_operationnel)
    update_database_cycle_operationnel(cycle_operationnel.value)
})

confidentialite.addEventListener('change',function(event){
    verify_select(confidentialite)
    update_database_confidentialite(confidentialite.options[confidentialite.selectedIndex].value)
})

respo_acceptation_risque.addEventListener('change',function(event){
    verify_select(respo_acceptation_risque)
    update_database_respo_acceptation_risque(respo_acceptation_risque.options[respo_acceptation_risque.selectedIndex].value)
})

/*-------------------------------- FONCTIONS --------------------------------*/
function get_database_raci(){
    $.ajax({
        url: 'content/php/atelier1a/selection_raci.php',
        type: 'POST',
        dataType : 'html',
        success: function (resultat) {
            var raci_JSON = JSON.parse(resultat);
            var nombre_acteur = raci.rows[0].children.length
            var starter=0
            for(let j=1;j<nombre_acteur;j++){
                for(let i=0;i<(nombre_atelier-3);i++){
                        if(raci_JSON[starter][3]=='Réalisation')
                            raci.tBodies[0].children[i].children[j].children[0].selectedIndex=0
                        else if(raci_JSON[starter][3]=='Approbation')
                            raci.tBodies[0].children[i].children[j].children[0].selectedIndex=1
                        else if(raci_JSON[starter][3]=='Consultation')
                            raci.tBodies[0].children[i].children[j].children[0].selectedIndex=2
                        else
                            raci.tBodies[0].children[i].children[j].children[0].selectedIndex=3
                        starter++
                }
            }
        },
        error : function(erreur){
            alert('ERROR :'+erreur);
        }
    }); 
}

function update_database_raci(){
    var nombre_acteur = raci.rows[0].children.length
    for(let j=1;j<nombre_acteur;j++){
        for(let i=0;i<nombre_atelier-3;i++){
            raci.tBodies[0].children[i].children[j].addEventListener('change',function(){
                find_atelier_num = raci.tBodies[0].children[i].children[0].attributes[0].value
                find_raci_value = raci.tBodies[0].children[i].children[j].children[0].options[raci.tBodies[0].children[i].children[j].children[0].selectedIndex].value
                find_acteur_id = raci.tHead.children[0].children[j].children[0].innerText
                $.ajax({
                    url: 'content/php/atelier1a/modification_raci.php',
                    type: 'POST',
                    data: {
                        acteur_id: find_acteur_id,
                        atelier_num: find_atelier_num,
                        raci_value: find_raci_value
                    },
                });
            })
        }
    }
}

function update_full_raci(){
    var nombre_acteur = raci.rows[0].children.length
    for(let i=1;i<nombre_acteur;i++){
        raci.tHead.children[2].children[i].addEventListener('change',function(){
            find_raci_value = raci.tHead.children[2].children[i].children[0].options[raci.tHead.children[2].children[i].children[0].selectedIndex].value
            find_acteur_id = raci.tHead.children[0].children[i].children[0].innerText
            $.ajax({
                url: 'content/php/atelier1a/modification_full_raci.php',
                type: 'POST',
                data: {
                    acteur_id: find_acteur_id,
                    raci_value: find_raci_value
                },
                success: function (resultat) {
                    location.reload();
                }
            });
        })
    }
}

function get_database_project_info(){
    $.ajax({
        url: 'content/php/atelier1a/selection_projet.php',
        type: 'POST',
        dataType : 'html',
        success: function (resultat) {
            var projet_info = JSON.parse(resultat);
            nom_etude.value = projet_info[0][1]
            objectif_atteindre.value = projet_info[0][2]
            if(projet_info[0][11]!=null)        
                respo_acceptation_risque.value=projet_info[0][11]        
            else 
                respo_acceptation_risque.selectedIndex=0    
            cadre_temporel.value = projet_info[0][3]
            cadre_temporel_etape_2.value = projet_info[0][4]
            cadre_temporel_etape_3.value = projet_info[0][5]
            cadre_temporel_etape_4.value = projet_info[0][6]
            cadre_temporel_etape_5.value = projet_info[0][7]
            confidentialite.value = projet_info[0][8]
            cycle_strategique.value = projet_info[0][9]
            cycle_operationnel.value = projet_info[0][10]

            verify_input(nom_etude.value,regex_nom_etude,nom_etude)
            verify_textarea(objectif_atteindre.value,regex_objectif_atteindre,objectif_atteindre)
            verify_input(cadre_temporel.value,regex_cadre_temporel,cadre_temporel)
            verify_input(cadre_temporel_etape_2.value,regex_cadre_temporel,cadre_temporel_etape_2)
            verify_input(cadre_temporel_etape_3.value,regex_cadre_temporel,cadre_temporel_etape_3)
            verify_input(cadre_temporel_etape_4.value,regex_cadre_temporel,cadre_temporel_etape_4)
            verify_input(cadre_temporel_etape_5.value,regex_cadre_temporel,cadre_temporel_etape_5)
            verify_select(confidentialite)
            verify_select(respo_acceptation_risque)
            verify_input(cycle_operationnel.value,regex_cycle,cycle_operationnel)
            verify_input(cycle_strategique.value,regex_cycle,cycle_strategique)
            activate_label(nom_etude.value,label_nom_etude)
         },
        error : function(erreur){
            alert('ERROR :'+erreur);
        }
    }); 
}

function update_database_nom_etude(nom_etude){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            nom_etude: nom_etude
        },
    }); 
}

function update_database_description_etude(description_etude){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            description_etude: description_etude
        },
    }); 
}

function update_database_objectif_atteindre(objectif_atteindre){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            objectif_atteindre: objectif_atteindre
        },
    }); 
}

function update_database_respo_acceptation_risque(respo_acceptation_risque){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            respo_acceptation_risque: respo_acceptation_risque
        },
    }); 
}

function update_database_cadre_temporel(cadre_temporel){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            cadre_temporel: cadre_temporel
        },
    }); 
}

function update_database_cadre_temporel_etape_2(cadre_temporel){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            cadre_temporel_etape_2: cadre_temporel
        },
    }); 
}

function update_database_cadre_temporel_etape_3(cadre_temporel){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            cadre_temporel_etape_3: cadre_temporel
        },
    }); 
}

function update_database_cadre_temporel_etape_4(cadre_temporel){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            cadre_temporel_etape_4: cadre_temporel
        },
    }); 
}

function update_database_cadre_temporel_etape_5(cadre_temporel){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            cadre_temporel_etape_5: cadre_temporel
        },
    }); 
}

function update_database_confidentialite(confidentialite){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            confidentialite: confidentialite
        },
    }); 
}

function update_database_cycle_strategique(cycle_strategique){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            cycle_strategique: cycle_strategique
        },
    }); 
}

function update_database_cycle_operationnel(cycle_operationnel){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            cycle_operationnel: cycle_operationnel
        },
    }); 
}

function update_database_grp_user_1a(nom_grp_utilisateur){
    $.ajax({
        url: 'content/php/atelier1a/modification_projet.php',
        type: 'POST',
        data: {
            nom_grp_utilisateur: nom_grp_utilisateur
        },
    }); 
}

/*----------------------------- EXPORT EXCEL --------------------------------*/
var d = new Date();
export_table_to_excel('editable_table','#button_download_acteurs','acteurs_'+d.YYYYMMDDHHMMSS()+'.xlsx')