/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");
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


$(document).ready(function () {
    $('#editable_table_mesure').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_mesure'],
            editable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});

$(document).ready(function () {
    $('#editable_table_mesure2').Tabledit({
        sortable: true,
        columns: {
            identifier: [0, 'id_partie_prenante'],
            editable: []
        },
        editButton: false,
        deleteButton: false,
        restoreButton: false
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_partie_prenante", "#editable_table tbody tr")
setSortTable('editable_table_scenario_strategique');
OURJQUERYFN.setFilterTable("#rechercher_scenario_strategique", "#editable_table_scenario_strategique tbody tr")
setSortTable('editable_table_mesure');
OURJQUERYFN.setFilterTable("#rechercher_mesure", "#editable_table_mesure tbody tr")
setSortTable('editable_table_mesure2');
OURJQUERYFN.setFilterTable("#rechercher_mesure2", "#editable_table_mesure2 tbody tr")

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
export_table_to_excel('editable_table_scenario_strategique','#button_download_scenarios_strategiques','scenarios_strategiques_'+d.YYYYMMDDHHMMSS()+'.xlsx')
export_table_to_excel('editable_table_mesure','#button_download_mesure_de_securite','mesure_de_securite_'+d.YYYYMMDDHHMMSS()+'.xlsx')
export_table_to_excel('editable_table_mesure2','#button_download_evaluation','evaluation_'+d.YYYYMMDDHHMMSS()+'.xlsx')
