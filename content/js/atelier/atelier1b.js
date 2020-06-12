$(document).ready(function(){  
    $('#tableau_mission').Tabledit({
     url:'content/php/atelier1b/modificationmission.php',
     sortable: true,
     columns:{
      identifier:[],
      editable:[0, "nom de la mission"]
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
    $('#taleau_vm').Tabledit({
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
