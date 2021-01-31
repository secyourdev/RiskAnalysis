/*------------------------------- VARIABLES ----------------------------------*/
var fileName_path;
var fileName;
var diagramUrl = fileName;

const inpFile = document.getElementById("inpFile")
var canvas = document.getElementById('canvas'); 
var modifier_schema = document.getElementsByClassName('schema_button')
var titre_schema = document.getElementById('titre_schema')
var text_schema = document.getElementsByClassName('text_schema')

var name_file;

var lenght_modifier_schema = modifier_schema.length

/*----------------------------------------------------------------------------*/
/*------------------------------- TRAITEMENT ---------------------------------*/
/*-------------------------- RECUPERATION DU PATH ----------------------------*/
$('.custom-file-input').on('change', function () {
    fileName_path = $(this).val()
    fileName = fileName_path.substring(fileName_path.lastIndexOf('\\') + 1)

    $(this).next('.custom-file-label').addClass("selected").html(fileName)
})
/*-------------------- CHARGEMENT DU SCHEMA VIA PARCOURIR --------------------*/
inpFile.addEventListener("change", function () {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            $.get(this.result, openDiagram, 'text');
        });
        
        reader.readAsDataURL(file);
    }
})
if(diagramUrl!=null)  
    $.get(diagramUrl, openDiagram, 'text');   

/*-------------------- ENREGISTREMENT EN LOCAL DU SCHEMA ----------------------------*/
$('#save-button').click(exportDiagram);
window.onload = main
/*----------------------- MODIFICATION TEXTE SCHEMA --------------------------*/
for(let h=0;h<modifier_schema.length;h++){
    modifier_schema[h].addEventListener('click',function(){
        sleep(500).then(() => {troncate_text_schema();});
    })
}    

canvas.addEventListener('mouseover',function(){
    sleep(500).then(() => {troncate_text_schema();});
})
/*----------------------------------------------------------------------------*/
/*------------------------------- FONCTIONS ----------------------------------*/
/*------------------------- TRONCATURE TEXTE SCHEMA --------------------------*/
function troncate_text_schema(){
    for(let i=0;i<text_schema.length;i++){
        if(text_schema[i].parentNode.childElementCount>1){
            for(let j=1;j<text_schema[i].parentNode.childElementCount;j++){
                text_schema[i].parentNode.children[j].style.display='none'
            }
            text_schema[i].parentNode.children[0].innerHTML = text_schema[i].parentNode.children[0].innerHTML.substring(0,text_schema[i].parentNode.children[0].innerHTML.length-3)+'...'
        }
    }
}
/*--------------------------- INSTANCE BPMN ---------------------------------*/
var bpmnModeler = new BpmnJS({
    container: '#canvas',
        keyboard: {
            bindTo: window
        }
});
/*---------------------------- EXPORT FILE ---------------------------------*/
async function exportDiagram() {
    try {
        var result = await bpmnModeler.saveXML({ format: true });
        console.log('DIAGRAM', result.xml);
    } catch (err) {
        console.error('could not save BPMN 2.0 diagram', err);
    }
}

function saveData(data, fileName) {
    var a = document.createElement("a");
    document.body.appendChild(a);
    a.style = "display: none";

    var json = JSON.stringify(data),
        blob = new Blob([data], {type: "text/plain;charset=utf-8"}),
        url = window.URL.createObjectURL(blob);
    a.href = url;
    a.download = fileName;
    a.click();
    window.URL.revokeObjectURL(url);
}

async function saveFile(e) {
    var result = await bpmnModeler.saveXML({ format: true });
    saveData(result.xml, name_file+".xml");
    e.preventDefault()
}

async function saveSVG(e) {
    var result = await bpmnModeler.saveSVG({ format: true });
    saveData(result.svg, name_file+".svg");
    e.preventDefault()
}

async function saveImage(e) {
    var result = await bpmnModeler.saveSVG({ format: true });
    //CODE A FAIRE 
    e.preventDefault()
}

async function saveFileBDD(e) {
    var result = await bpmnModeler.saveXML({ format: true });
    var url = 'data:application/xml,' + encodeURIComponent(result.xml);
    var value = parserXML(result.xml);
    if(value!=0){
        enregistrement_schema_fn(url);
        $('#button_schema_scenarios_strategiques').modal('hide');
        alert('Le schéma du scénario stratégique a bien été enregistré !')
        e.preventDefault()
    }
}
/*---------------------------- PARSER XML ----------------------------------*/
var parser, xmlDoc, test;
function parserXML(xml_file){
parser = new DOMParser();
xmlDoc = parser.parseFromString(xml_file,"application/xml");
var fleche = new Array(); 

for(let i=0;i<xmlDoc.getElementsByTagName("messageFlow").length;i++){
    fleche[i] = new Array();
}

for(let i=0;i<xmlDoc.getElementsByTagName("messageFlow").length;i++){
    if(xmlDoc.getElementsByTagName("messageFlow")[i].attributes.length!=4){
        alert('Veuillez compléter les informations manquantes sur les relations !');
        return 0;
    }
}

for(let i=0;i<xmlDoc.getElementsByTagName("messageFlow").length;i++){
    fleche[i][0]= xmlDoc.getElementsByTagName("messageFlow")[i].attributes[0].value
    if(xmlDoc.getElementsByTagName("messageFlow")[i].attributes[1].value.substring(0,2)=="EI"){
        fleche[i][1]= xmlDoc.getElementsByTagName("messageFlow")[i].attributes[1].value.substring(0,2)
        fleche[i][2]= xmlDoc.getElementsByTagName("messageFlow")[i].attributes[1].value.substring(5,xmlDoc.getElementsByTagName("messageFlow")[i].attributes[1].value.length)
    }
    else{
        fleche[i][1]= "ER"
        fleche[i][2]= xmlDoc.getElementsByTagName("messageFlow")[i].attributes[1].value
    }
    fleche[i][4]= xmlDoc.getElementsByTagName("messageFlow")[i].attributes[2].value
    fleche[i][8]= xmlDoc.getElementsByTagName("messageFlow")[i].attributes[3].value
}

for(let i=0;i<xmlDoc.getElementsByTagName("process").length;i++){
    for(let j=0;j<xmlDoc.getElementsByTagName("process")[i].children.length;j++){
        for(let k=0;k<fleche.length;k++){
            if(xmlDoc.getElementsByTagName("process")[i].children[j].attributes.length!=2){
                alert("Veuillez compléter les informations manquantes dans l'événement !");
                return 0;
            }
            else if(xmlDoc.getElementsByTagName("process")[i].children[j].attributes[0].value==fleche[k][4]){
                fleche[k][5]=xmlDoc.getElementsByTagName("process")[i].children[j].attributes[1].value
            }
            else if(xmlDoc.getElementsByTagName("process")[i].children[j].attributes[0].value==fleche[k][8]){
                fleche[k][9]=xmlDoc.getElementsByTagName("process")[i].children[j].attributes[1].value
            } 
        }  
    }
}

for(let i=0;i<evenement_redoutes_JSON.length;i++){
    for(let k=0;k<fleche.length;k++){
        if(evenement_redoutes_JSON[i][1]==fleche[k][2])
            fleche[k][3]=evenement_redoutes_JSON[i][0];       
    }
}

for(let i=0;i<SROV_JSON.length;i++){
    for(let k=0;k<fleche.length;k++){
        if(SROV_JSON[i][1]==fleche[k][5]){
            fleche[k][6]=SROV_JSON[i][0];
            fleche[k][7]="SROV";
        }
        if(SROV_JSON[i][1]==fleche[k][9]){
            fleche[k][10]=SROV_JSON[i][0];
            fleche[k][11]="SROV";
        }
    }
}

for(let i=0;i<valeur_metier_JSON.length;i++){
    for(let k=0;k<fleche.length;k++){
        if(valeur_metier_JSON[i][1]==fleche[k][5]){
            fleche[k][6]=valeur_metier_JSON[i][0];
            fleche[k][7]="Valeur Métier";
        }
        if(valeur_metier_JSON[i][1]==fleche[k][9]){
            fleche[k][10]=valeur_metier_JSON[i][0];
            fleche[k][11]="Valeur Métier";
        }
    }
}

for(let i=0;i<partie_prenante_JSON.length;i++){
    for(let k=0;k<fleche.length;k++){
        if(partie_prenante_JSON[i][1]==fleche[k][5]){
            fleche[k][6]=partie_prenante_JSON[i][0];
            fleche[k][7]="Partie Prenante";
        }
        if(partie_prenante_JSON[i][1]==fleche[k][9]){
            fleche[k][10]=partie_prenante_JSON[i][0];
            fleche[k][11]="Partie Prenante";
        }
    }
}

for(let i=0;i<fleche.length;i++){
    console.log(i + ":")
    console.log("id : "+fleche[i][0]);
    console.log("type : "+fleche[i][1]);
    console.log("EI/ER_value : "+fleche[i][2]);
    console.log("id_ER : "+fleche[i][3]);
    console.log("Source : "+fleche[i][4]);
    console.log("Name : "+fleche[i][5]);
    console.log("id_source : "+fleche[i][6]);
    console.log("type_source : " + fleche[i][7]);
    console.log("Destination : "+fleche[i][8]);
    console.log("Name : "+fleche[i][9]);
    console.log("id_dest : "+fleche[i][10]);
    console.log("type_destination : " + fleche[i][11]);
    console.log('\n')
}

$.ajax({
    url: 'content/php/atelier3b/suppression_EI.php',
    type: 'POST',
    data:{
        id_scenario_strategique: id_scenario_strategique_schema
    }
})

$.ajax({
    url: 'content/php/atelier3b/suppression_ER.php',
    type: 'POST',
    data:{
        id_scenario_strategique: id_scenario_strategique_schema
    }
})

// Ajout des EI/ER dans la base de données
    for(let i=0;i<fleche.length;i++){
        if(fleche[i][1]=="EI"){
            $.ajax({
                url: 'content/php/atelier3b/ajout_EI.php',
                type: 'POST',
                data:{
                    id_fleche: fleche[i][0],
                    valeur_chemin: fleche[i][2],
                    id_scenario_strategique: id_scenario_strategique_schema,
                    id_source : fleche[i][6],
                    type_source : fleche[i][7],
                    id_schema_source : fleche[i][4],
                    id_destination : fleche[i][10],
                    id_schema_destination : fleche[i][8],
                    type_destination : fleche[i][11],
                }
            })
        }
        else if(fleche[i][3]!=null){
            $.ajax({
                url: 'content/php/atelier3b/ajout_ER.php',
                type: 'POST',
                data:{
                    id_fleche: fleche[i][0],
                    valeur_chemin: fleche[i][2],
                    id_evenement_redoute: fleche[i][3],
                    id_scenario_strategique: id_scenario_strategique_schema,
                    id_source : fleche[i][6],
                    type_source : fleche[i][7],
                    id_schema_source : fleche[i][4],
                    id_destination : fleche[i][10],
                    id_schema_destination : fleche[i][8],
                    type_destination : fleche[i][11],
                }
            })
        }
        else{
            alert("Votre schéma comporte des erreurs sur les valeurs des chemins !")
            return 0;
        }
    }

// faire un tableau regroupant toute les données à envoyé sur la bdd
// envoyer les données sur la bdd tout en vérifiant que les anciennes données ont été supprimé 
// pour cela, on supprime à chaque fois toutes les données du scénario stratégique pour créer des
// nouvelles

}
/*------------------------- SEND DATA TO BDD -----------------------------  */
function sendDataToBDD(table){
}
/*---------------------------- OPEN SCHEMA ---------------------------------*/
async function openDiagram(bpmnXML) {
    try {              
        await bpmnModeler.importXML(bpmnXML);
    } catch (err) {
        console.error('Could not import BPMN 2.0 diagram !', err);
    }
}
/*---------------------------- NOM SCHEMA ---------------------------------*/
function name_schema(id_projet,nom_scenario){
    var d = new Date();
    return "projet_"+id_projet+"_schema_"+nom_scenario+"_"+d.YYYYMMDDHHMMSS()
}
function suppression_espace(value){
    return value.replace(/ /g, '_');
}
/*------------------------------- MAIN ------------------------------------*/
function main() {
    var savefile = document.getElementById("savefile")
    var savefilebdd = document.getElementById('savefilebdd')
    var saveimage = document.getElementById('saveimage')
    savefile.addEventListener("click", saveFile, false)
    savefilebdd.addEventListener('click',saveFileBDD,false)
    saveimage.addEventListener('click',saveSVG,false)
}

