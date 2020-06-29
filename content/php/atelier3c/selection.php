<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v9");
//affichage tableau partie prenante
$query = "SELECT * FROM partie_prenante";
$query_categorie_partie_prenante = "SELECT categorie_partie_prenante FROM partie_prenante";

$result = mysqli_query($connect, $query);
$result_categorie_partie_prenante = mysqli_query($connect, $query_categorie_partie_prenante);

//affichage tableau scenario
$query_scenario_strategique = "SELECT * FROM scenario_strategique ORDER BY id_scenario_strategique ASC";
$query_chemin_d_attaque = "SELECT * FROM chemin_d_attaque_strategique ORDER BY id_chemin_d_attaque_strategique ASC";
$result_scenario_strategique = mysqli_query($connect, $query_scenario_strategique);
$result_chemin_d_attaque = mysqli_query($connect, $query_chemin_d_attaque);

//tableau mesures

$query_mesure =
"SELECT 
chemin_d_attaque_strategique.id_chemin_d_attaque_strategique, 
partie_prenante.nom_partie_prenante, 
chemin_d_attaque_strategique.chemin_d_attaque_strategique, 
referentiel.regles, 
partie_prenante.niveau_de_menace_partie_prenante, 
chemin_d_attaque_strategique.niveau_de_menance_residuelle 
FROM partie_prenante, chemin_d_attaque_strategique, referentiel, scenario_strategique 
WHERE chemin_d_attaque_strategique.id_scenario_strategique = scenario_strategique.id_scenario_strategique 
AND scenario_strategique.id_partie_prenante = partie_prenante.id_partie_prenante 
ORDER BY id_chemin_d_attaque_strategique ASC";

$result_mesure = mysqli_query($connect, $query_mesure);