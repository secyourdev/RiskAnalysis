/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

var nommesure = document.getElementById("nommesure");
var descriptionmesure = document.getElementById("descriptionmesure");
var label_mesure = document.getElementById("nommesure").previousSibling.previousSibling

var regex_nom = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{0,100}$/
var regex_description = /^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s-.:,'"–]{0,100}$/

/*------------------------------- SIDEBAR ----------------------------------*/
show_sub_content()
sidebarToggleTop.addEventListener('click', show_sub_content,false);
sidebarToggle.addEventListener('click',show_sub_content,false);
window.addEventListener('resize', show_sub_content, false);
function show_sub_content(){
    var Atelier1 = document.getElementById('Atelier3');
    if(!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(min-width: 768px)").matches)){
        Atelier1.classList.add('show')
    }
}
/*--------------------------------- TABLES JS -------------------------------*/

$(document).ready(function () {
    $('#editable_table').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_partie_prenante'],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});

<<<<<<< HEAD

$(document).ready(function () {
    $('#editable_table_scenario_strategique').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_scenario_strategique'],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});


=======
>>>>>>> origin/Carlos
$(document).ready(function () {
    $('#editable_table_mesure').Tabledit({
        url: 'content/php/atelier3c/modification_mesure1.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_mesure'],
            editable: [
<<<<<<< HEAD
                [4, 'nom_mesure_securite'],
                [5, 'description_mesure_securite']
=======
                [3, 'nom_mesure_securite'],
                [4, 'description_mesure_securite']
>>>>>>> origin/Carlos
            ]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
<<<<<<< HEAD
                $('#' + data.id_evenement_redoutes).remove();
=======
                $('#' + data.id_mesure).remove();
>>>>>>> origin/Carlos
            }
        }
    });
});

$(document).ready(function () {
    $('#editable_table_mesure2').Tabledit({
        url: 'content/php/atelier3c/modification_mesure2.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_partie_prenante'],
            editable: [

                [7, 'dependance_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
                [8, 'penetration_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
                [9, 'maturite_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}'],
                [10, 'confiance_residuelle', '{"1" : "1", "2" : "2", "3" : "3", "4" : "4"}']
            ]
        },
        deleteButton: false,
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_evenement_redoutes).remove();
            }
        }
    });
});



/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_partie_prenante", "#editable_table tbody tr")
<<<<<<< HEAD
setSortTable('editable_table_scenario_strategique');
OURJQUERYFN.setFilterTable("#rechercher_scenario_strategique", "#editable_table_scenario_strategique tbody tr")
=======
>>>>>>> origin/Carlos
setSortTable('editable_table_mesure');
OURJQUERYFN.setFilterTable("#rechercher_mesure", "#editable_table_mesure tbody tr")
setSortTable('editable_table_mesure2');
OURJQUERYFN.setFilterTable("#rechercher_mesure2", "#editable_table_mesure2 tbody tr")
/*------------------------------ LABELS CACHES ------------------------------*/
//label_mesure.style.display="none"

/*----------------------- -- VERIFICATION DES CHAMPS -- ------------------------*/
nommesure.addEventListener('keyup',function(event){
    verify_input(nommesure.value,regex_nom,nommesure)
    activate_label(nommesure.value,label_mesure)
}) 

descriptionmesure.addEventListener('keyup',function(event){
    verify_textarea(descriptionmesure.value,regex_description,descriptionmesure)
})

$("#editable_table > tbody > tr > td:nth-child(10)").each(function () {
    if ($(this)[0].innerText == "Pas critique") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "Critique") { $(this)[0].classList.add('fond-rouge'); }
});

/*-------------------------------- CANVAS -----------------------------------*/
myChart_interne = document.getElementById("myChart_interne")
myChart_interne_residuelle = document.getElementById("myChart_interne_residuelle")
myChart_externe = document.getElementById("myChart_externe")
myChart_externe_residuelle = document.getElementById("myChart_externe_residuelle")

button_pp_interne= document.getElementById("button_pp_interne")
button_pp_externe= document.getElementById("button_pp_externe")

myChart_externe.style.display="none"
myChart_externe_residuelle.style.display="none"
button_pp_externe.style.backgroundColor='#64789A'
button_pp_externe.style.border='#64789A'
fleche_externe.style.display="none"

fleche_interne = document.getElementById('fleche_interne')
fleche_externe = document.getElementById('fleche_externe')

button_pp_interne.addEventListener("click",function(){
    myChart_interne.style.display="inline"
    myChart_interne_residuelle.style.display="inline"
    myChart_externe.style.display="none"
    myChart_externe_residuelle.style.display="none"
    button_pp_interne.style.backgroundColor='#394C7A'
    button_pp_interne.style.border='#394C7A'
    button_pp_externe.style.backgroundColor='#64789A'
    button_pp_externe.style.border='#64789A'
    fleche_interne.style.display="flex"
    fleche_externe.style.display="none"
})

button_pp_externe.addEventListener("click",function(){
    myChart_externe.style.display="inline"
    myChart_externe_residuelle.style.display="inline"
    myChart_interne.style.display="none"
    myChart_interne_residuelle.style.display="none"
    button_pp_externe.style.backgroundColor='#394C7A'
    button_pp_externe.style.border='#394C7A'
    button_pp_interne.style.backgroundColor='#64789A'
    button_pp_interne.style.border='#64789A'
    fleche_interne.style.display="none"
    fleche_externe.style.display="flex"
})

window.addEventListener('resize', fleche_resize, false);

function fleche_resize(){
    if((window.matchMedia("(max-width: 577px)").matches)&&(window.matchMedia("(min-width: 0px)").matches)){
        fleche_interne.style.display="none"
        fleche_externe.style.display="none"
    }
    else{
        if(button_pp_interne.style.backgroundColor=='rgb(100, 120, 154)'){
            fleche_interne.style.display="none"
            fleche_externe.style.display="flex"
        }
        else if (button_pp_externe.style.backgroundColor=='rgb(100, 120, 154)'){
            fleche_interne.style.display="flex"
            fleche_externe.style.display="none"
        }
    }
}

/*----------------------------- EXPORT EXCEL --------------------------------*/
var d = new Date();

export_table_to_excel('editable_table','#button_download_parties_prenantes','parties_prenantes_'+d.YYYYMMDDHHMMSS()+'.xlsx')
<<<<<<< HEAD
export_table_to_excel('editable_table_scenario_strategique','#button_download_scenarios_strategiques','scenarios_strategiques_'+d.YYYYMMDDHHMMSS()+'.xlsx')
=======
>>>>>>> origin/Carlos
export_table_to_excel('editable_table_mesure','#button_download_mesure_de_securite','mesure_de_securite_'+d.YYYYMMDDHHMMSS()+'.xlsx')
export_table_to_excel('editable_table_mesure2','#button_download_evaluation','evaluation_'+d.YYYYMMDDHHMMSS()+'.xlsx')
