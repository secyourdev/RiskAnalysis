<?php
// session_start();
$getid_projet = $_SESSION['id_projet'];

include("content/php/bdd/connexion_sqli.php");

<<<<<<< HEAD
$query = "";
// $query = "SELECT
// T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique,
// T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
// M_evenement_redoute.niveau_de_gravite,
// U_scenario_operationnel.vraisemblance,
// X_revaluation_du_risque.nom_risque_residuelle,
// X_revaluation_du_risque.description_risque_residuelle,
// X_revaluation_du_risque.vraisemblance_residuelle,
// X_revaluation_du_risque.risque_residuel,
// X_revaluation_du_risque.gestion_risque_residuelle,
// X_revaluation_du_risque.id_revaluation

// FROM T_chemin_d_attaque_strategique, M_evenement_redoute, U_scenario_operationnel, X_revaluation_du_risque, S_scenario_strategique

// WHERE X_revaluation_du_risque.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
// AND U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
// AND T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique
// AND S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
// AND X_revaluation_du_risque.id_projet = $getid_projet";
$query = "SELECT
T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
M_evenement_redoute.nom_evenement_redoute,
Y_mesure.nom_mesure,
M_evenement_redoute.niveau_de_gravite,
M_evenement_redoute.nom_evenement_redoute,
=======
$query = "SELECT 
U_scenario_operationnel.id_scenario_operationnel,
T_chemin_d_attaque_strategique.id_risque,
T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
>>>>>>> origin/Carlos
U_scenario_operationnel.vraisemblance,
X_revaluation_du_risque.nom_risque_residuelle,
X_revaluation_du_risque.description_risque_residuelle,
X_revaluation_du_risque.vraisemblance_residuelle,
X_revaluation_du_risque.risque_residuel,
X_revaluation_du_risque.gestion_risque_residuelle,
<<<<<<< HEAD
X_revaluation_du_risque.id_revaluation

FROM T_chemin_d_attaque_strategique, M_evenement_redoute, U_scenario_operationnel, X_revaluation_du_risque, S_scenario_strategique,ZB_comporter_2,Y_mesure

WHERE X_revaluation_du_risque.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique
AND S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
AND ZB_comporter_2.id_mesure = Y_mesure.id_mesure
AND X_revaluation_du_risque.id_projet = $getid_projet";
=======
X_revaluation_du_risque.id_revaluation,
Y_mesure.nom_mesure,
M_evenement_redoute.niveau_de_gravite,
M_evenement_redoute.nom_evenement_redoute
FROM U_scenario_operationnel,T_chemin_d_attaque_strategique, X_revaluation_du_risque, ZB_comporter_2, Y_mesure, UA_ER, M_evenement_redoute
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = X_revaluation_du_risque.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = UA_ER.id_chemin_d_attaque_strategique
AND ZB_comporter_2.id_mesure = Y_mesure.id_mesure
AND UA_ER.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
AND U_scenario_operationnel.id_projet = $getid_projet";
>>>>>>> origin/Carlos

$querylegende = "SELECT DISTINCT id_risque, nom_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);

$resultlegendeavant = mysqli_query($connect, $querylegende);
$resultlegendeapres = mysqli_query($connect, $querylegende);

<<<<<<< HEAD
$qr_eval_risk_resi = "SELECT X_revaluation_du_risque.id_revaluation, X_revaluation_du_risque.nom_risque_residuelle, X_revaluation_du_risque.gestion_risque_residuelle, X_revaluation_du_risque.risque_residuel, X_revaluation_du_risque.gestion_risque_residuelle, X_revaluation_du_risque.vraisemblance_residuelle, X_revaluation_du_risque.description_risque_residuelle, M_evenement_redoute.nom_evenement_redoute, U_scenario_operationnel.id_risque,M_evenement_redoute.niveau_de_gravite, Y_mesure.nom_mesure, U_scenario_operationnel.vraisemblance FROM  X_revaluation_du_risque NATURAL JOIN M_evenement_redoute NATURAL JOIN U_scenario_operationnel NATURAL JOIN Y_mesure WHERE id_projet = $getid_projet";
$qr_eval_risk_resi_tab = mysqli_query($connect, $qr_eval_risk_resi);

// $risque_init = array();
// foreach ($result as $row) {
//     $vraisemblance = $row['vraisemblance'];
//     $niveau_de_gravite = $row['niveau_de_gravite'];

//     $risque_initial = $vraisemblance * $niveau_de_gravite;

//     $risque_init[] = array(
//         "risque_initial" => $risque_initial,
//     );
// };
=======
?>
>>>>>>> origin/Carlos
