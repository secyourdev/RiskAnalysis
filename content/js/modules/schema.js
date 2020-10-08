var fileName_path;
var fileName;

var diagramUrl = fileName;
const inpFile = document.getElementById("inpFile");

$('.custom-file-input').on('change', function () {
    fileName_path = $(this).val()
    fileName = fileName_path.substring(fileName_path.lastIndexOf('\\') + 1)

    $(this).next('.custom-file-label').addClass("selected").html(fileName)
})

inpFile.addEventListener("change", function () {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            $.get(this.result, openDiagram, 'text');
        });
        
        reader.readAsDataURL(file);
    }else{
        console.log("erreur!")
    }

})

// modeler instance
var bpmnModeler = new BpmnJS({
container: '#canvas',
keyboard: {
    bindTo: window
}
});

/**
 * Save diagram contents and print them to the console.
 */
async function exportDiagram() {

try {

    var result = await bpmnModeler.saveXML({ format: true });

    alert('Diagram exported. Check the developer tools!');

    console.log('DIAGRAM', result.xml);
} catch (err) {

    console.error('could not save BPMN 2.0 diagram', err);
}
}

/**
 * Open diagram in our modeler instance.
 *
 * @param {String} bpmnXML diagram to display
 */
async function openDiagram(bpmnXML) {

// import diagram
try {

    await bpmnModeler.importXML(bpmnXML);

    // access modeler components
    var canvas = bpmnModeler.get('canvas');
    var overlays = bpmnModeler.get('overlays');


    // zoom to fit full viewport
    canvas.zoom('fit-viewport');

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


// load external diagram file via AJAX and open it
if(diagramUrl!=null)
    $.get(diagramUrl, openDiagram, 'text');            

// wire save button
$('#save-button').click(exportDiagram);

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

function main() {
var savefile = document.getElementById("savefile")
savefile.addEventListener("click", saveFile, false)
}

async function saveFile(e) {
var result = await bpmnModeler.saveXML({ format: true });
saveData(result.xml, "test.bpmn");

e.preventDefault()
}

window.onload = main
