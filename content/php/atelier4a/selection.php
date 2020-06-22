<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v6");
$query1 = "SELECT nom_scenario_strategique, description_source_de_risque, objectif_vise, nom_evenement_redoute, id_risque, chemin_d_attaque_strategique, niveau_de_gravite FROM scenario_strategique 
INNER JOIN SROV ON scenario_strategique.id_source_de_risque = SROV.id_source_de_risque 
INNER JOIN evenement_redoute ON scenario_strategique.id_evenement_redoute = evenement_redoute.id_evenement_redoute
INNER JOIN partie_prenante ON scenario_strategique.id_partie_prenante = partie_prenante.id_partie_prenante 
INNER JOIN chemin_d_attaque_strategique On scenario_strategique.id_scenario_strategique = chemin_d_attaque_strategique.id_scenario_strategique
";


$result1 = mysqli_query($connect, $query1);

?>