/*------------------------------- VARIABLES ----------------------------------*/
var nom_etude = document.getElementById('nom_etude');
var objectif_atteindre = document.getElementById('objectif_atteindre');
var cadre_temporel = document.getElementById('cadre_temporel');


var label_nom_etude = document.getElementById('nom_etude').previousSibling.previousSibling
var label_cadre_temporel = document.getElementById('cadre_temporel').previousSibling.previousSibling
var raci = document.getElementById('raci')
var acteur_id_raci = document.getElementById('acteur_id_raci')
var radio_gravite4 = document.getElementById('radio_gravite4')
var radio_gravite5 = document.getElementById('radio_gravite5')
var respo_acceptation_risque = document.getElementById('respo_acceptation_risque')
var find_acteur_id;
var find_atelier_num;
var find_raci_value;

var nombre_atelier = raci.rows.length

/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function(){  
    $('#editable_table').Tabledit({
     columns:{
      identifier:[0, "id_utilisateur"],
      editable:[]
     },
     restoreButton:false,
     editButton: false,
     deleteButton: false,
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
/*-------------------------- INITIALISATION RACI --------------------------- */
for(let i=2;i<nombre_atelier;i++){
    var nombre_acteur = raci.rows[0].children.length-1
    while(nombre_acteur!=0){
        var choix_raci = document.createElement("td")
        var div = document.createElement("div")
        choix_raci.appendChild(div)
        raci.rows[i].appendChild(choix_raci)
        nombre_acteur--
    }
}
/*----------------- RECUPERATION & MODIFICATION VALEURS RACI ---------------- */
acteur_id_raci.style.display ='none'
get_database_raci()
/*------------------------ RECUPERATION & MODIFICATION ----------------------*/
get_database_project_info()
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
                for(let i=0;i<(nombre_atelier-2);i++){
                    raci.tBodies[0].children[i].children[j].children[0].innerText=raci_JSON[starter][2]
                        starter++
                }
            }
        },
        error : function(erreur){
            alert('ERROR :'+erreur);
        }
    }); 
}

function get_database_project_info(){
    $.ajax({
        url: 'content/php/atelier1a/selection_projet.php',
        type: 'POST',
        dataType : 'html',
        success: function (resultat) {
            var projet_info = JSON.parse(resultat);
            nom_etude.innerText = projet_info[0][1]
            objectif_atteindre.innerText = projet_info[0][2]

            if(projet_info[0][3]=="Directeur")
                respo_acceptation_risque.innerText="Directeur"
            else if(projet_info[0][3]=="RSSI")
                respo_acceptation_risque.innerText="RSSI"
            else 
                respo_acceptation_risque.innerText="Responsable Informatique"
            
            if(projet_info[0][4]==4)
                radio_gravite4.innerText="Gravité sur 4"
            else 
                radio_gravite4.innerText="Gravité sur 5"
           
            cadre_temporel.innerText = projet_info[0][5]
            
            activate_label(nom_etude.innerText,label_nom_etude)
            activate_label(cadre_temporel.innerText,label_cadre_temporel)
        },
        error : function(erreur){
            alert('ERROR :'+erreur);
        }
    }); 
}