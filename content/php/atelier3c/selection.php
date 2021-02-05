<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

//affichage tableau partie prenante
$query_partie_prenante = "SELECT * FROM R_partie_prenante WHERE id_projet = $getid_projet";
$result_partie_prenante = mysqli_query($connect, $query_partie_prenante);
$result_partie_prenante2 = mysqli_query($connect, $query_partie_prenante);

$query_mesure1 = "SELECT
Y_mesure.id_mesure,
Y_mesure.nom_mesure,
Y_mesure.description_mesure,
R_partie_prenante.nom_partie_prenante,
T_chemin_d_attaque_strategique.id_risque
FROM R_partie_prenante, ZB_comporter_2, Y_mesure, T_chemin_d_attaque_strategique
WHERE R_partie_prenante.id_partie_prenante = ZB_comporter_2.id_partie_prenante
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
AND Y_mesure.id_mesure = ZB_comporter_2.id_mesure
AND Y_mesure.id_projet = $getid_projet";

$query_chemin = "SELECT DISTINCT T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique, 
T_chemin_d_attaque_strategique.id_risque, 
T_chemin_d_attaque_strategique.id_chemin,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique
FROM S_scenario_strategique, T_chemin_d_attaque_strategique, UA_ER, M_evenement_redoute
WHERE T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique 
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = UA_ER.id_chemin_d_attaque_strategique
AND UA_ER.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet
ORDER BY T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique ASC";

$result_chemin = mysqli_query($connect, $query_chemin);

$query_mesure2 = "SELECT DISTINCT 
R_partie_prenante.id_partie_prenante,
nom_partie_prenante, 
dependance_partie_prenante,
penetration_partie_prenante,
maturite_partie_prenante,
confiance_partie_prenante, 
niveau_de_menace_partie_prenante,
dependance_residuelle,
penetration_residuelle,
maturite_residuelle,
confiance_residuelle,
niveau_de_menace_residuelle
FROM R_partie_prenante
INNER JOIN ZB_comporter_2
ON R_partie_prenante.id_partie_prenante = ZB_comporter_2.id_partie_prenante
INNER JOIN Y_mesure
ON Y_mesure.id_mesure = ZB_comporter_2.id_mesure
WHERE Y_mesure.id_projet = $getid_projet";


$result_mesure1 = mysqli_query($connect, $query_mesure1);
$result_mesure2 = mysqli_query($connect, $query_mesure2);

// $query_referentiel = "SELECT * FROM N_socle_de_securite WHERE id_projet = $getid_projet";
// $result_referentiel = mysqli_query($connect, $query_referentiel);