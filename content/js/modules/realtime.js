/*------------------------------- FONCTIONS --------------------------------*/
function verify_input(value,regex,input){
    if(regex.test(value)) input.style.borderBottom="2px solid #4AD991";
    else if(value.length==0) input.style.borderBottom="1px solid #64789A";
    else input.style.borderBottom="2px solid #FF6565";
}

function verify_textarea(value,regex,input){
    if(regex.test(value)) input.style.border="2px solid #4AD991";
    else if(value.length==0) input.style.border="1px solid #64789A";
    else input.style.border="2px solid #FF6565";
}

function verify_textarea_2(value,regex,bool,input,save){
    if(regex.test(value)){
        input.style.border="2px solid #4AD991";
        bool = true;
        save.disabled = false
    }
    else if(value.length==0){
        input.style.border="1px solid #64789A";
        bool = false;
        save.disabled = true
    }
    else{
        input.style.border="2px solid #FF6565";
        bool = false;
        save.disabled = true
    }
    return bool
}

function activate_label(value,label){
    if(value.length!=0) label.style.display='inline'
    else label.style.display='none'
}

function tableau_verification(value_test){
    var table = document.getElementById('editable_table')
    var table_cells_length = table.rows[0].cells.length; 
    var bool =new Array()
    var bool_final=true;
    var regex = /^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/
        for(let j=1;j<table_cells_length-1;j++){
            bool[j] = verify_textarea_2(table.rows[value_test].cells[j].children[1].value,regex,bool,table.rows[value_test].cells[j].children[1],save_button[value_test-1])
            table.rows[value_test].cells[j].children[1].addEventListener('keyup',function(event){
                bool[j]= verify_textarea_2(table.rows[value_test].cells[j].children[1].value,regex,bool,table.rows[value_test].cells[j].children[1],save_button[value_test-1])
            })
        }
        for(let i=1;i<table_cells_length-1;i++){
            bool_final = bool_final&&bool[i]

        }
    return bool_final
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function acteur_verification(){
    if(bool_nom_acteur&&bool_prenom_acteur&&bool_poste_acteur) valider_acteur.disabled = false
    else valider_acteur.disabled = true
}