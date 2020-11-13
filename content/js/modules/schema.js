/*------------------------------- VARIABLES ----------------------------------*/
var fileName_path;
var fileName;
var diagramUrl = fileName;

const inpFile = document.getElementById("inpFile")
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
    enregistrement_schema_fn(url);
    $('#button_schema_scenarios_strategiques').modal('hide');
    alert('Le schéma du scénario stratégique a bien été enregistré !')
    e.preventDefault()
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

