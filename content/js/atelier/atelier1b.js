$(document).ready(function(){  
    $('#editable_table').Tabledit({
     url:'content/php/atelier1b/modificationmission.php',
     sortable: true,
     columns:{
      identifier:[0, 'id_mission'],
      editable:[[1, 'nom_mission']]
     },
     restoreButton:false,
     onSuccess:function(data, textStatus, jqXHR)
     {
      if(data.action == 'delete')
      {
       $('#'+data.id_mission).remove();
      }
     }
    });
    $('#tableau_vm').Tabledit({
     url:'content/php/atelier1b/modificationvm.php',
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
    $('#tableau_bs').Tabledit({
     url:'content/php/atelier1b/modificationbs.php',
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
