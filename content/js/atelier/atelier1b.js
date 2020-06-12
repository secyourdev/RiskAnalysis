$(document).ready(function(){  
    $('#editable_table').Tabledit({
     url:'content/php/atelier1b/modification.php',
     sortable: true,
     columns:{
      identifier:[0, "id_personne"],
      editable:[[1, 'nom'], [2, 'prenom'], [3, 'poste']]
     },
     restoreButton:false,
     onSuccess:function(data, textStatus, jqXHR)
     {
      if(data.action == 'delete')
      {
       $('#'+data.id_personne).remove();
      }
     }
    });
});
