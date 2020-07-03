var button = document.getElementsByClassName('tabledit-edit-button')
var save_button = document.getElementsByClassName('tabledit-save-button')
var j=0;
var k=0;
var l=0;
/*--------------------------------- TABLES JS -------------------------------*/
$(document).ready(function(){  
    
    $('#editable_table').Tabledit({
        url:'content/php/atelier5bpacs/modification.php',
     columns:{
      identifier:[0, 'id_traitement_de_securite'],
      editable:[[1, 'principe_de_securite', '{"Gouvernance" : "Gouvernance", "Protection" : "Protection", "Defense" : "Defense", "Resilience" : "Resilience"}'], 
      [2, "difficulte_traitement_de_securite"], 
      [3, "scenario_risques_associes"], 
      [4, "responsable"], 
      [5, "cout_traitement_de_securite", '{"+" : "+", "++" : "++", "+++" : "+++"}'], 
      [6, "date_traitement_de_securite"], 
      [7, "statut", '{"A lancer" : "A lancer", "En cours" : "En cours", "Terminé" : "Terminé"}']]
    // editable:[[4, "vraisemblance", '{"1" : "1 (Invraisemblable)", "2" : "2 (Peu vraisemblable)", "3" : "3 (Vraisemblable)", "4" : "4 (Très vraisemblable)", "5" : "5 (Quasi certain)"}']]
     },
     restoreButton:false,
     deleteButton: false
    
    });
});

/*--------------------------- SORT & FILTER TABLES --------------------------*/
setSortTable('editable_table');
OURJQUERYFN.setFilterTable("#rechercher_chemin","#editable_table tbody tr")

/*------------------ AJOUT DE LA VERIFICATION DES TABLEAUX ------------------*/
sleep(100).then(() => {
    for(let i=0;i<editable_table.rows.length-1;i++){
        j=i+1;
        button[i].setAttribute('onclick','tableau_verification('+j+','+'editable_table'+','+'8'+')')
    }
});


