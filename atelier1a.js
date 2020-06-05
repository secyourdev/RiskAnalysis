/*------------------------------ VARIABLES -----------------------------------*/
var th_id=document.getElementById('th_id')
var th_nom=document.getElementById('th_nom')
var th_prenom=document.getElementById('th_prenom')
var th_poste=document.getElementById('th_poste')
var input_id=document.getElementById('input_id')
var input_nom_acteur=document.getElementById('input_nom_acteur')
var input_prenom_acteur=document.getElementById('input_prenom_acteur')
var input_poste_acteur=document.getElementById('input_poste_acteur')
var table_acteur= [input_id,input_nom_acteur,input_prenom_acteur,input_poste_acteur]


var id_suppr=document.getElementById('input_id_suppr')
var nom_suppr=document.getElementById('input_nom_suppr')
var prenom_suppr=document.getElementById('input_prenom_suppr')
var table_acteur_suppr= [id_suppr,nom_suppr,prenom_suppr]

var table=document.getElementById("dataTable")

/*----------------------------- TRAITEMENT -----------------------------------*/
sleep(500).then(() => {
    tableau_modification("dataTable");
    click_pencil();
    click_bin();
});

th_id.addEventListener('click',function(event){
    sleep(500).then(() => {
        tableau_modification("dataTable"); 
        click_pencil();
        click_bin();
    });
})

th_nom.addEventListener('click',function(event){
    sleep(500).then(() => {
        tableau_modification("dataTable"); 
        click_pencil();
        click_bin();
    });
})

th_prenom.addEventListener('click',function(event){
    sleep(500).then(() => {
        tableau_modification("dataTable");
        click_pencil();
        click_bin();
     });
})

th_poste.addEventListener('click',function(event){
    sleep(500).then(() => {
        tableau_modification("dataTable");
        click_pencil();
        click_bin();
     });
})

/*----------------------------- FONCTIONS -----------------------------------*/

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function click_pencil(){
    var table_length=table.rows.length;
    for(let i=1;i<table_length;i++){
        document.getElementById('pencil'+i).addEventListener('click',function(event){
            var value=modify_with_pencil('pencil'+i);
            for(let j=0;j<table_acteur.length;j++){
                table_acteur[j].value = value[j]
            }
        })
    }
}


function click_bin(){
    var table_length=table.rows.length;
    for(let i=1;i<table_length;i++){
        document.getElementById('bin'+i).addEventListener('click',function(event){
            console.log("coucou")
            var value=modify_with_pencil('bin'+i);
            for(let j=0;j<table_acteur_suppr.length;j++){
                table_acteur_suppr[j].value = value[j]
            }
        })
    }
}