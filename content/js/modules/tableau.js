
/*----------------------------- VARIABLES ---------------------------------*/
var table = document.getElementById('editable_table')
var table_cells_length = table.rows[0].cells.length; 
var table_rows_length = table.rows.length; 

var bool_nom_etude = false
var regex_nom_etude = /^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/
/*----------------------------- TRAITEMENT --------------------------------*/
for(let i=0;i<table_cells_length;i++){
    table.rows[0].cells[i].setAttribute("onclick", "sortTable("+i+")");
}
/*----------------------------- FONCTIONS ---------------------------------*/

/* sort table */
function sortTable(n) {
    var element = table.rows[0].cells[n];
    /* clearfix */
    for (i = 0; i < table_cells_length; i++) {
        if (table.rows[0].cells[i] != element) {
            table.rows[0].cells[i].className = "";
        }
    }
    element.classList.toggle("az");
    if (element.className == "") {
        element.className = ("za");
    }
    else {
        element.classList.remove("za");
    }

    var rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;

    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (n == 0) {
                if (dir == "asc") {
                    if (Number(x.firstChild.innerHTML) > Number(y.firstChild.innerHTML)) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
                else if (dir == "desc") {
                    if (Number(x.firstChild.innerHTML) < Number(y.firstChild.innerHTML)) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            } else if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount++;
        } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
/* filter */
$(document).ready(function () {
    $("#rechercher_input").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#editable_table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
