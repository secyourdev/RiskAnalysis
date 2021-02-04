<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

$query_pacs = "SELECT
ZA_traitement_de_securite.id_traitement_de_securite,
Y_mesure.nom_mesure,
Y_mesure.description_mesure,
Y_mesure.id_atelier AS Y_id_atelier,
T_chemin_d_attaque_strategique.id_risque,
ZA_traitement_de_securite.principe_de_securite,
ZA_traitement_de_securite.responsable,
ZA_traitement_de_securite.difficulte_traitement_de_securite,
ZA_traitement_de_securite.cout_traitement_de_securite,
ZA_traitement_de_securite.date_traitement_de_securite,
ZA_traitement_de_securite.statut
FROM ZA_traitement_de_securite, ZB_comporter_2, Y_mesure, R_partie_prenante, T_chemin_d_attaque_strategique 
WHERE ZA_traitement_de_securite.id_mesure = Y_mesure.id_mesure
AND Y_mesure.id_mesure = ZB_comporter_2.id_mesure
AND ZB_comporter_2.id_partie_prenante = R_partie_prenante.id_partie_prenante 
AND ZB_comporter_2.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND ZA_traitement_de_securite.id_projet = $getid_projet
AND Y_mesure.id_projet = $getid_projet
AND R_partie_prenante.id_projet = $getid_projet
";

$result_pacs = mysqli_query($connect, $query_pacs);

$querychemin = "SELECT * FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE T_chemin_d_attaque_strategique.id_projet = $getid_projet";
$querylegende = "SELECT DISTINCT id_risque, nom_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE T_chemin_d_attaque_strategique.id_projet = $getid_projet";

$resultchemin = mysqli_query($connect, $querychemin);
$query_referentiel = "SELECT * FROM N_socle_de_securite WHERE id_projet = $getid_projet";
$result_referentiel = mysqli_query($connect, $query_referentiel);
$resultlegende = mysqli_query($connect, $querylegende);
?>