<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

$query_pacs = "SELECT DISTINCT
ZA_traitement_de_securite.id_traitement_de_securite,
Y_mesure.id_mesure,
Y_mesure.nom_mesure,
Y_mesure.description_mesure,
Y_mesure.id_atelier AS Y_id_atelier,
ZA_traitement_de_securite.principe_de_securite,
ZA_traitement_de_securite.responsable,
ZA_traitement_de_securite.difficulte_traitement_de_securite,
ZA_traitement_de_securite.cout_traitement_de_securite,
ZA_traitement_de_securite.date_traitement_de_securite,
ZA_traitement_de_securite.statut,
T_chemin_d_attaque_strategique.id_risque
FROM Y_mesure, ZB_comporter_2, ZA_traitement_de_securite, T_chemin_d_attaque_strategique
WHERE Y_mesure.id_mesure = ZB_comporter_2.id_mesure
AND Y_mesure.id_mesure = ZA_traitement_de_securite.id_mesure
AND ZB_comporter_2.id_chemin_d_attaque_strategique=T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND Y_mesure.id_projet=$getid_projet
GROUP BY ZA_traitement_de_securite.id_traitement_de_securite WITH ROLLUP
";// Problème de lien/affichage entre l'atelier 3.c et 5.b à regler !!

$result_pacs = mysqli_query($connect, $query_pacs);

$querychemin = "SELECT DISTINCT 
T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique,
T_chemin_d_attaque_strategique.id_risque, 
T_chemin_d_attaque_strategique.id_chemin,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique 
FROM S_scenario_strategique, T_chemin_d_attaque_strategique, UA_ER
WHERE T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique 
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = UA_ER.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet
ORDER BY T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique ASC";
$resultchemin = mysqli_query($connect, $querychemin);


$query_referentiel = "SELECT * FROM N_socle_de_securite WHERE id_projet = $getid_projet";
$result_referentiel = mysqli_query($connect, $query_referentiel);

$querylegende = "SELECT DISTINCT id_risque, nom_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE T_chemin_d_attaque_strategique.id_projet = $getid_projet";
$resultlegende = mysqli_query($connect, $querylegende);
?>