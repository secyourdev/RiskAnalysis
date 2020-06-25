<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v9");

//affichage tableau de rappel
$query_evenement_redoutes = "SELECT * FROM evenement_redoute INNER JOIN valeur_metier on evenement_redoute.id_valeur_metier = valeur_metier.id_valeur_metier";
$query_SROV = "SELECT id_source_de_risque, type_d_attaquant_source_de_risque,profil_de_l_attaquant_source_de_risque, description_source_de_risque, objectif_vise, description_objectif_vise FROM SROV ORDER BY id_source_de_risque";

//affichage tableau modifiable
$query_scenario_strategique = "SELECT * FROM scenario_strategique ORDER BY id_scenario_strategique ASC";
$query_chemin_d_attaque = "SELECT * FROM chemin_d_attaque_strategique ORDER BY id_chemin_d_attaque_strategique ASC";


// $query_chemin_attaque = "SELECT id_chemin_d_attaque_strategique, nom_scenario_strategique,description_source_de_risque,objectif_vise,nom_evenement_redoute, id_risque, chemin_d_attaque_strategique, niveau_de_gravite FROM chemin_d_attaque_strategique, scenario_strategique, SROV , evenement_redoute WHERE chemin_d_attaque_strategique.id_scenario_strategique = scenario_strategique.id_scenario_strategique AND scenario_strategique.id_evenement_redoute = evenement_redoute.id_evenement_redoute AND scenario_strategique.id_source_de_risque = SROV.id_source_de_risque";
// $query_id_risque = "SELECT id_risque FROM chemin_d_attaque_strategique, scenario_strategique, SROV , evenement_redoute WHERE chemin_d_attaque_strategique.id_scenario_strategique = scenario_strategique.id_scenario_strategique AND scenario_strategique.id_evenement_redoute = evenement_redoute.id_evenement_redoute AND scenario_strategique.id_source_de_risque = SROV.id_source_de_risque";
// $query_nom_evenement_redoute = "SELECT nom_evenement_redoute FROM chemin_d_attaque_strategique, scenario_strategique, SROV , evenement_redoute WHERE chemin_d_attaque_strategique.id_scenario_strategique = scenario_strategique.id_scenario_strategique AND scenario_strategique.id_evenement_redoute = evenement_redoute.id_evenement_redoute AND scenario_strategique.id_source_de_risque = SROV.id_source_de_risque";

$result_evenement_redoutes = mysqli_query($connect, $query_evenement_redoutes);
$result_SROV = mysqli_query($connect, $query_SROV);

$result_scenario_strategique = mysqli_query($connect, $query_scenario_strategique);
$result_chemin_d_attaque = mysqli_query($connect, $query_chemin_d_attaque);

// $result_chemin_attaque = mysqli_query($connect, $query_chemin_attaque);
// $result_id_risque = mysqli_query($connect, $query_id_risque);
// $result_nom_evenement_redoute = mysqli_query($connect, $query_nom_evenement_redoute);
