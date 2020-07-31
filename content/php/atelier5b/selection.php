<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

$query_pacs = "SELECT * 
FROM ZA_traitement_de_securite, ZB_comporter_2, Y_mesure, T_chemin_d_attaque_strategique
WHERE ZA_traitement_de_securite.id_mesure = Y_mesure.id_mesure
AND Y_mesure.id_mesure = ZB_comporter_2.id_mesure
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
AND ZA_traitement_de_securite.id_projet = $getid_projet
AND Y_mesure.id_projet = $getid_projet
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet
";

$result_pacs = mysqli_query($connect, $query_pacs);

$querychemin = "SELECT * FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE id_projet = $getid_projet";
$querylegende = "SELECT DISTINCT id_risque, nom_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE id_projet = $getid_projet";

$resultchemin = mysqli_query($connect, $querychemin);
$query_referentiel = "SELECT * FROM N_socle_de_securite WHERE id_projet = $getid_projet";
$result_referentiel = mysqli_query($connect, $query_referentiel);
$resultlegende = mysqli_query($connect, $querylegende);
?>