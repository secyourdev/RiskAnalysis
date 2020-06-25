<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v9");

//affichage tableau de rappel
$query_evenement_redoutes = "SELECT * FROM evenement_redoute INNER JOIN valeur_metier on evenement_redoute.id_valeur_metier = valeur_metier.id_valeur_metier";
$query_SROV = "SELECT id_source_de_risque, type_d_attaquant_source_de_risque,profil_de_l_attaquant_source_de_risque, description_source_de_risque, objectif_vise, description_objectif_vise FROM SROV ORDER BY id_source_de_risque";

//affichage tableau modifiable
$query_scenario_strategique = "SELECT * FROM scenario_strategique ORDER BY id_scenario_strategique ASC";
$query_chemin_d_attaque = "SELECT * FROM chemin_d_attaque_strategique ORDER BY id_chemin_d_attaque_strategique ASC";


$result_evenement_redoutes = mysqli_query($connect, $query_evenement_redoutes);
$result_SROV = mysqli_query($connect, $query_SROV);

$result_scenario_strategique = mysqli_query($connect, $query_scenario_strategique);
$result_chemin_d_attaque = mysqli_query($connect, $query_chemin_d_attaque);





//modal scenario strat
$query_id_source_de_risque = "SELECT id_source_de_risque, description_source_de_risque, objectif_vise FROM SROV ORDER BY id_source_de_risque ASC";
$query_id_evenement_redoute = "SELECT id_evenement_redoute, nom_evenement_redoute FROM evenement_redoute ORDER BY id_evenement_redoute ASC";
$query_id_partie_prenante = "SELECT id_partie_prenante, nom_partie_prenante FROM partie_prenante ORDER BY id_partie_prenante ASC";

$result_id_source_de_risque = mysqli_query($connect, $query_id_source_de_risque);
$result_id_evenement_redoute = mysqli_query($connect, $query_id_evenement_redoute);
$result_id_partie_prenante = mysqli_query($connect, $query_id_partie_prenante);


//modal chemin strat
$query_id_scenario_strategique = "SELECT id_scenario_strategique, nom_scenario_strategique FROM scenario_strategique ORDER BY id_scenario_strategique ASC";

$result_id_scenario_strategique = mysqli_query($connect, $query_id_scenario_strategique);