/*------------------------------- VARIABLES ----------------------------------*/
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");

/*------------------------------- SIDEBAR ----------------------------------*/
show_sub_content()
sidebarToggleTop.addEventListener('click', show_sub_content, false);
sidebarToggle.addEventListener('click', show_sub_content, false);
window.addEventListener('resize', show_sub_content, false);
function show_sub_content() {
    var Atelier1 = document.getElementById('Atelier1');
    if (!accordionSidebar.classList.contains('toggled') && (window.matchMedia("(min-width: 768px)").matches)) {
        Atelier1.classList.add('show')
    }
}

$(document).ready(function () {
    $('#editable_table_socle').Tabledit({
        url: 'content/php/atelier1d/modification_socle.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_socle_securite'],
            editable: [
                // [1, 'type_referentiel'],
                // [2, 'nom_referentiel'],
                [3, 'etat_d_application', '{"Non appliqué" : "Non appliqué" , "Appliqué sans restriction" : "Appliqué sans restriction" , "Appliqué avec restriction" : "Appliqué avec restriction"}'],
                [4, 'etat_de_la_conformite']
            ],
            // checkboxeditable: [],
            dateeditable: []
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_socle_securite).remove();
            }
        }
    });
});
$(document).ready(function () {
    $('#editable_table_ecart').Tabledit({
        url: 'content/php/atelier1d/modification_regle.php',
        sortable: true,
        columns: {
            identifier: [0, 'id_ecarts'],
            editable: [
                // [1, 'id_regle'],
                // [2, 'titre'],
                // [3, 'description'],
                [4, 'etat_de_la_regle', '{"Non traité" : "Non traité" , "Conforme" : "Conforme" , "Partiellement conforme" : "Partiellement conforme" ,  "Non conforme" : "Non conforme", "Non applicable" : "Non applicable"}'],
                [5, 'justification_ecart'],
                [6, 'nom'],
                // [7, 'date']
            ],

            dateeditable: [[7, 'date']]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.id_ecarts).remove();
            }
        }
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table_socle');
OURJQUERYFN.setFilterTable("#rechercher_socle", "#editable_table_socle tbody tr")
/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table_ecart');
OURJQUERYFN.setFilterTable("#rechercher_ecart", "#editable_table_ecart tbody tr")



/*--------------------------- Couleurs État --------------------------*/
$("#editable_table_socle > tbody > tr > td:nth-child(4)").each(function () {

    if ($(this)[0].innerText == "Appliqué sans restriction") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "Appliqué avec restriction") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "Non appliqué") { $(this)[0].classList.add('fond-rouge'); }

});



/*--------------------------- Couleurs regle --------------------------*/
$("#editable_table_ecart > tbody > tr > td:nth-child(5)").on().each(function () {

    // if ($(this)[0].innerText == "Non traité") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "Conforme") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "Partiellement conforme") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "Non conforme") { $(this)[0].classList.add('fond-rouge'); }
    // if ($(this)[0].innerText == "Non applicable") { $(this)[0].classList.add('fond-rouge'); }

});

