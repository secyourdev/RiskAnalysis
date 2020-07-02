
const selectsocle = document.getElementById('nomreferentiel');

selectsocle.addEventListener('change', (event) => {
    //   const result = document.querySelector('.result');
    //   console.log(`Valeur  ${selectsocle.value}`);
    $.ajax({
        url: 'content/php/atelier1d/ecrire_tableau_ecarts.php',
        type: 'POST',
        data: {
            nom_referentiel: selectsocle.value
        },
        success: function (data) {
            //   console.log(data);
            document.getElementById('ecrire_ecart').innerHTML = data;

            $('#tableau_niveau').Tabledit({
                deleteButton: false,
                url: 'content/php/atelier1b/modification_ecart.php',
                columns: {
                    identifier: [0, "id_ecarts"],
                    editable: [
                        // [1, 'id_regle'],
                        // [2, 'titre'],
                        [3, 'etat_de_la_regle'],
                        [4, 'justification_ecart'],
                        [5, 'nom'],
                        [6, 'date'],
                    ]
                },
                restoreButton: false,
                onSuccess: function (data, textStatus, jqXHR) {
                    if (data.action == 'delete') {
                        $('#' + data.id_valeur_metier).remove();
                    }
                }
            });
        }
    })


});