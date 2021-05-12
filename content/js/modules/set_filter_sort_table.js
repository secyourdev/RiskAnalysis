function setSortTable(table_name){
var table = document.getElementById(table_name)
var table_cells_length = table.rows[0].cells.length; 

    for(let i=0;i<table_cells_length;i++){
        table.rows[0].cells[i].setAttribute("onclick", "sortTable("+i+","+table_name+")");
    }
}
  
OURJQUERYFN = {
    setFilterTable : function(rechercher,table){
        $(document).ready(function () {
            $(rechercher).on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $(table).filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    }
}

