
const selectsocle = document.getElementById('nomreferentiel');

selectsocle.selectedIndex = sessionStorage.getItem('selectsocle')
selectSocle(selectsocle.value);

selectsocle.addEventListener('change', (event) => {
    sessionStorage.setItem('selectsocle',selectsocle.selectedIndex);
    selectSocle(selectsocle.options[selectsocle.options.selectedIndex].value);
    location.reload();
});

function selectSocle(selected_value){
    $.ajax({
        url: 'content/php/atelier1d/ecrire_tableau_regle.php',
        type: 'POST',
        data: {
            nom_referentiel: selected_value
        },
        success: function (data) {
            document.getElementById('ecrire_ecart').innerHTML = data;
            $('#editable_table_ecart').Tabledit({
                url: 'content/php/atelier1d/modification_regle.php',
                columns: {
                    identifier: [0, "id_regle"],
                    editable: [
                        [1, 'id_regle_affichage'],
                        [2, 'titre'],
                        [3, 'description'],
                        [4, 'etat_de_la_regle', '{"Non traité" : "Non traité" , "Conforme" : "Conforme" , "Partiellement conforme" : "Partiellement conforme" ,  "Non conforme" : "Non conforme", "Non applicable" : "Non applicable"}'],
                        [5, 'justification_ecart'],
                        [6, 'responsable'],                    
                    ],
                    dateeditable: [[7, 'dates']]
                },
                deleteButton: true,
                restoreButton: false,
                onSuccess: function (data, textStatus, jqXHR) {
                    if (data.action == 'delete') {
                        $('#' + data.id_valeur_metier).remove();
                    }
                }
            });
        }
    })
}