
const selectsocle = document.getElementById('nomreferentiel');

selectsocle.selectedIndex = sessionStorage.getItem('selectsocle')
selectSocle(selectsocle.value);

selectsocle.addEventListener('change', (event) => {
    sessionStorage.setItem('selectsocle',selectsocle.selectedIndex);
    selectSocle(selectsocle.options[selectsocle.options.selectedIndex].value);
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
                deleteButton: false,
                url: 'content/php/atelier1b/modification_regle.php',
                columns: {
                    identifier: [0, "id_regle"],
                    editable: [],
                    dateeditable: []
                },
                restoreButton: false,
                editButton: false,
                deleteButton: false,
                onSuccess: function (data, textStatus, jqXHR) {
                    if (data.action == 'delete') {
                        $('#' + data.id_valeur_metier).remove();
                    }
                }
            });
        }
    })
}