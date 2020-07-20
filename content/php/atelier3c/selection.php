<?php
$getid_projet = intval($_GET['id_projet']);
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");
//affichage tableau partie prenante

$query_partie_prenante = "SELECT * FROM partie_prenante WHERE id_projet = $getid_projet";
$result_partie_prenante = mysqli_query($connect, $query_partie_prenante);
$result_partie_prenante2 = mysqli_query($connect, $query_partie_prenante);

$query_categorie_partie_prenante = "SELECT categorie_partie_prenante FROM partie_prenante";
$result_categorie_partie_prenante = mysqli_query($connect, $query_categorie_partie_prenante);

//affichage tableau scenario
$query_chemin_d_attaque = "SELECT * FROM chemin_d_attaque_strategique ORDER BY id_chemin_d_attaque_strategique ASC";
$result_chemin_d_attaque = mysqli_query($connect, $query_chemin_d_attaque);

//tableau scénario stratégique
$query_scenario_strategique =
"SELECT 
scenario_strategique.id_scenario_strategique,
nom_scenario_strategique, 
scenario_strategique.id_source_de_risque, 
scenario_strategique.id_evenement_redoute, 
nom_evenement_redoute, 
niveau_de_gravite, 
SROV.description_source_de_risque, 
objectif_vise 
FROM scenario_strategique, evenement_redoute, SROV 
WHERE scenario_strategique.id_evenement_redoute = evenement_redoute.id_evenement_redoute 
AND scenario_strategique.id_source_de_risque = SROV.id_source_de_risque 
AND scenario_strategique.id_projet = $getid_projet
ORDER BY id_scenario_strategique ASC";
$result_scenario_strategique = mysqli_query($connect, $query_scenario_strategique);

//tableau mesures

// Si utilisation des mesures de référentiel

// $query_mesure =
// "SELECT 
// chemin_d_attaque_strategique.id_chemin_d_attaque_strategique,
// nom_partie_prenante, 
// nom_chemin_d_attaque_strategique,
// regle.description, 
// niveau_de_menace_partie_prenante,
// niveau_de_menace_residuelle
// FROM chemin_d_attaque_strategique
// INNER JOIN comporter_3
// ON chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = comporter_3.id_chemin_d_attaque_strategique
// INNER JOIN regle
// ON regle.id_regle = comporter_3.id_regle
// INNER JOIN partie_prenante
// ON chemin_d_attaque_strategique.id_partie_prenante = partie_prenante.id_partie_prenante
// WHERE id_projet = $getid_projet";

$query_mesure = "SELECT
mesure.id_mesure,
nom_partie_prenante, 
nom_chemin_d_attaque_strategique,
mesure.nom_mesure,
mesure.description_mesure,
dependance_residuelle,
penetration_residuelle,
maturite_residuelle,
confiance_residuelle, 
niveau_de_menace_partie_prenante,
niveau_de_menace_residuelle
FROM chemin_d_attaque_strategique
INNER JOIN comporter_2
ON chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = comporter_2.id_chemin_d_attaque_strategique
INNER JOIN mesure
ON mesure.id_mesure = comporter_2.id_mesure
INNER JOIN partie_prenante
ON chemin_d_attaque_strategique.id_partie_prenante = partie_prenante.id_partie_prenante
WHERE id_projet = $getid_projet
";

$result_mesure = mysqli_query($connect, $query_mesure);



$query_referentiel = "SELECT * FROM socle_de_securite WHERE id_projet = $getid_projet";
$result_referentiel = mysqli_query($connect, $query_referentiel);