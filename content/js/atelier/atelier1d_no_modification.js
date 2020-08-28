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
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function () {
    $('#editable_table_socle').Tabledit({
        columns: {
            identifier: [0, 'id_socle_securite'],
            editable: [],
            dateeditable: []
        },
        restoreButton: false,
        editButton: false,
        deleteButton: false
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table_socle');
OURJQUERYFN.setFilterTable("#rechercher_socle", "#editable_table_socle tbody tr")
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
    if ($(this)[0].innerText == "Conforme") { $(this)[0].classList.add('fond-vert'); }
    if ($(this)[0].innerText == "Partiellement conforme") { $(this)[0].classList.add('fond-orange'); }
    if ($(this)[0].innerText == "Non conforme") { $(this)[0].classList.add('fond-rouge'); }
});

/*----------------------------- EXPORT EXCEL --------------------------------*/
export_table_to_excel('editable_table_socle','#button_download_socle_de_securite','socle_de_securite.xlsx')
