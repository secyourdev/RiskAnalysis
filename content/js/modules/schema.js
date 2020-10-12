/*------------------------------- VARIABLES ----------------------------------*/
var fileName_path;
var fileName;
var diagramUrl = fileName;

const inpFile = document.getElementById("inpFile")
var modifier_schema = document.getElementsByClassName('schema_button')

var lenght_modifier_schema = modifier_schema.length

var id_scenario_strategique_schema;

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
/*---------------------- RECUPERATION en BDD DU SCHEMA ------------------------------*/
recuperation_schema_fn()
/*--------------------- ENREGISTREMENT en BDD DU SCHEMA -----------------------------*/
/*A FAIRE*/
enregistrement_schema_fn()
/*------------------------ CREATION en BDD DU SCHEMA --------------------------------*/
/*CREE UN SCHEMA LORS DE LA CREATION DU SCENARIO*/

/*----------------------------------------------------------------------------*/
/*------------------------------- FONCTIONS ----------------------------------*/
/*----------------------- RECUPERATION DU SCHEMA SUR BDD ---------------------*/
function recuperation_schema_fn(){
    for(let i=0;i<lenght_modifier_schema;i++){
        modifier_schema[i].addEventListener('click',function(){

            $.ajax({
                url: 'content/php/atelier3b/selection_schema.php',
                type: 'POST',
                data: {
                    id_scenario_strategique: modifier_schema[i].parentNode.parentNode.id,
                },
                dataType: 'html',
                success: function (resultat) {
                    var schema_JSON = JSON.parse(resultat);
                    $.get(schema_JSON[0][0], openDiagram, 'text');
                    id_scenario_strategique_schema = modifier_schema[i].parentNode.parentNode.id
                }
            })
        });
    }
}
/*----------------------- AJOUT DU SCHEMA SUR BDD ----------------------------*/
function enregistrement_schema_fn(schema_file){     
        $.ajax({
            url: 'content/php/atelier3b/ajout_schema.php',
            type: 'POST',
            data: {
                id_scenario_strategique: id_scenario_strategique_schema,
                schema : schema_file
            }
        })
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
    saveData(result.xml, "test.bpmn");
    $('#button_schema_scenarios_strategiques').modal('hide');
    e.preventDefault()
}

async function saveFileBDD(e) {
    var result = await bpmnModeler.saveXML({ format: true });
    var url = 'data:application/xml,' + encodeURIComponent(result.xml);
    enregistrement_schema_fn(url);
    $('#button_schema_scenarios_strategiques').modal('hide');
    e.preventDefault()
}
/*---------------------------- OPEN SCHEMA ---------------------------------*/
async function openDiagram(bpmnXML) {

    try {
        await bpmnModeler.importXML(bpmnXML);

        // access modeler components
        var canvas = bpmnModeler.get('canvas');
        var overlays = bpmnModeler.get('overlays');

        // attach an overlay to a node
        overlays.add('SCAN_OK', 'note', {
        position: {
            bottom: 0,
            right: 0
        },
        html: '<div class="diagram-note">Mixed up the labels?</div>'
        });

        // add marker
        canvas.addMarker('SCAN_OK', 'needs-discussion');
    } catch (err) {

        //console.error('could not import BPMN 2.0 diagram', err);
    }
}
/*----------------------------- MAIN -------------------------------------*/
function main() {
    var savefile = document.getElementById("savefile")
    var savefilebdd = document.getElementById('savefilebdd')
    savefile.addEventListener("click", saveFile, false)
    savefilebdd.addEventListener('click',saveFileBDD,false)
}


