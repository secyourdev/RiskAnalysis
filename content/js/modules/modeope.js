
const selectscenar = document.getElementById('nomscenar');

selectscenar.addEventListener('change', (event) => {
  //   const result = document.querySelector('.result');
    console.log(`Valeur  ${selectscenar.value}`);
  $.ajax({
    url: 'content/php/atelier4a/modeope.php',
    type: 'POST',
    data: {
      id_scenar: selectscenar.value
    },
    success: function (data) {
        console.log(data);
      document.getElementById('ecrire_mode').innerHTML = data;
      $('#tableau_mode_ope').Tabledit({
        url:'content/php/atelier4a/modificationmodeope.php',
        columns:{
         identifier:[0, "id_mode_operatoire"],
         editable:[[2, 'mode_operatoire']]
        },
        restoreButton:false,
        onSuccess:function(data, textStatus, jqXHR)
        {
         if(data.action == 'delete')
         {
          $('#'+data.id_bien_support).remove();
         }
        }
       });
    }
  })


});