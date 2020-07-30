<?php
// session_start();
$getid_projet = $_SESSION['id_projet'];

include("content/php/bdd/connexion_sqli.php");

$query = "";
$query = "SELECT 
T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique, 
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
M_evenement_redoute.niveau_de_gravite,
U_scenario_operationnel.vraisemblance,
X_revaluation_du_risque.nom_risque_residuelle,
X_revaluation_du_risque.description_risque_residuelle,
X_revaluation_du_risque.vraisemblance_residuelle,
X_revaluation_du_risque.risque_residuel,
X_revaluation_du_risque.gestion_risque_residuelle,
X_revaluation_du_risque.id_revaluation

FROM T_chemin_d_attaque_strategique, M_evenement_redoute, U_scenario_operationnel, X_revaluation_du_risque, S_scenario_strategique

WHERE X_revaluation_du_risque.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique
AND S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
AND X_revaluation_du_risque.id_projet = $getid_projet";

$querylegende = "SELECT DISTINCT id_risque, nom_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);

$resultlegendeavant = mysqli_query($connect, $querylegende);
$resultlegendeapres = mysqli_query($connect, $querylegende);

// $risque_init = array();
// foreach ($result as $row) {
//     $vraisemblance = $row['vraisemblance'];
//     $niveau_de_gravite = $row['niveau_de_gravite'];

//     $risque_initial = $vraisemblance * $niveau_de_gravite;

//     $risque_init[] = array(
//         "risque_initial" => $risque_initial,
//     );
// };