
const select_scenario_operationnel = document.getElementById('select_scenario_operationnel');

select_scenario_operationnel.addEventListener('change', (event) => {
    //   const result = document.querySelector('.result');
    //   console.log(`Valeur  ${select_scenario_operationnel.value}`);
    $.ajax({
        url: 'testimagephp.php',
        type: 'POST',
        data: {
            id_scenario_operationnel: select_scenario_operationnel.value
        },
        // success: function (data) {
        //     //   console.log(data);
        //     document.getElementById('ecrire_ecart').innerHTML = data;
        //     // $('#editable_table_ecart tbody').append(data);
        //     $('#editable_table_ecart').Tabledit({
        //         deleteButton: false,
        //         url: 'content/php/atelier1b/modification_regle.php',
        //         columns: {
        //             identifier: [0, "id_regle"],
        //             editable: [
        //                 // [1, 'id_regle_affichage'],
        //                 // [2, 'titre'],
        //                 // [3, 'description'],
        //                 [4, 'etat_de_la_regle', '{"Non traité" : "Non traité" , "Conforme" : "Conforme" , "Partiellement conforme" : "Partiellement conforme" ,  "Non conforme" : "Non conforme", "Non applicable" : "Non applicable"}'],
        //                 [5, 'justification_ecart'],
        //                 [6, 'responsable'],
        //                 // [7, 'dates']
                        
        //             ],
        //             dateeditable: [[7, 'dates']]
        //         },
        //         restoreButton: false,
        //         onSuccess: function (data, textStatus, jqXHR) {
        //             if (data.action == 'delete') {
        //                 $('#' + data.id_valeur_metier).remove();
        //             }
        //         }
        //     });
        // }
    })


});