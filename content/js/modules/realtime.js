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

function verify_textarea_2(value,regex,input,save){
    var bool = true;

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

function tableau_verification(value_test,name_table,table_cells_length){
    var table = name_table
    //var bool_initial = new Array()
    var bool =new Array()
    //var final;
    var bool_final=true;
    //console.log(value_test)
    //console.log(name_table)
    //console.log(table_cells_length)
    var regex = /^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/
        for(let j=1;j<table_cells_length;j++){
            bool[j] = verify_textarea_2(table.rows[value_test].cells[j].children[1].value,regex,table.rows[value_test].cells[j].children[1],save_button[value_test-1])
            //console.log('bool['+j+'] :'+bool[j])
            //bool_final = bool[j]&&bool[j+1]
            table.rows[value_test].cells[j].children[1].addEventListener('keyup',function(){
                bool[j] = verify_textarea_2(table.rows[value_test].cells[j].children[1].value,regex,table.rows[value_test].cells[j].children[1],save_button[value_test-1])    
                // for(let i=1;i<table_cells_length;i++){
                    
                //     console.log('bool['+i+'] :'+bool[i])
                //     bool_final = bool_final&&bool[i]
                //     console.log(bool_final)
                //     //return bool_final
                // }
                // final=bool_final
                //console.log(bool2)
                //return bool
                //console.log(bool)
            })
            
        }
    //bool=bool2;
    //     if (event.keyCode === 13) {
        // for(let i=1;i<table_cells_length;i++){
        //     bool_final = bool_final&&bool[i]
        //     console.log(bool_final)
        // }
    //     }
    //     else console.log('bobo')

    //console.log(bool)
    return bool
}


function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function acteur_verification(){
    if(bool_nom_acteur&&bool_prenom_acteur&&bool_poste_acteur) valider_acteur.disabled = false
    else valider_acteur.disabled = true
}