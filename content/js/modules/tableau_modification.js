function tableau_modification(table_ID){
    table = document.getElementById(table_ID)
    table_length = table.rows.length;
    for(let i=1;i<table_length;i++){
        var td = document.createElement("td")
        var div = document.createElement("div")
        var i1 = document.createElement("i")
        var i2 = document.createElement('i')
        td.setAttribute("class","perso_border")
        div.setAttribute("class", "modification")
        i1.setAttribute("data-toggle","modal")
        i1.setAttribute("data-target","#modif_acteur")
        i1.setAttribute("class","crayon fas fa-pen")
        i1.setAttribute("id","pencil"+i)

        i2.setAttribute("data-toggle","modal")
        i2.setAttribute("data-target","#suppr_acteur")
        i2.setAttribute("class","poubelle fas fa-trash-alt")
        i2.setAttribute("id","bin"+i)
        table.rows[i].appendChild(td)
        td.appendChild(div)
        div.appendChild(i1)
        div.appendChild(i2)
    }
}

function modify_with_pencil(crayon_id){
    var id=document.getElementById(crayon_id)
    var value = new Array();
    var parent = id.parentNode.parentNode.parentNode.children
    var parent_length = parent.length
    for(let i=0;i<parent_length-1;i++){
        value[i]= parent[i].innerHTML;
    }
   return value
}