<?php
// session_start();
$getid_projet = $_SESSION['id_projet'];

include("content/php/bdd/connexion_sqli.php");

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
U_scenario_operationnel.id_scenario_operationnel,
T_chemin_d_attaque_strategique.id_risque,
T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
U_scenario_operationnel.vraisemblance,
X_revaluation_du_risque.nom_risque_residuelle,
X_revaluation_du_risque.description_risque_residuelle,
X_revaluation_du_risque.vraisemblance_residuelle,
X_revaluation_du_risque.risque_residuel,
X_revaluation_du_risque.gestion_risque_residuelle,
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

$querylegende = "SELECT DISTINCT id_risque, nom_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);

$resultlegendeavant = mysqli_query($connect, $querylegende);
$resultlegendeapres = mysqli_query($connect, $querylegende);

$qr_eval_risk_resi = "SELECT
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique AS 'Nom du risque',
M_evenement_redoute.nom_evenement_redoute AS 'Événement redouté',
Y_mesure.nom_mesure AS 'Mesure de sécurité',
M_evenement_redoute.niveau_de_gravite AS 'Gravité initiale',
U_scenario_operationnel.vraisemblance AS 'Vraisemblance initiale',
U_scenario_operationnel.vraisemblance * M_evenement_redoute.niveau_de_gravite AS 'Risque initial',
X_revaluation_du_risque.nom_risque_residuelle AS 'Nom du risque résiduel',
X_revaluation_du_risque.description_risque_residuelle AS 'Description du risque résiduel',
X_revaluation_du_risque.vraisemblance_residuelle AS 'Vraisemblance résiduelle',
X_revaluation_du_risque.risque_residuel AS 'Risque résiduelle',
X_revaluation_du_risque.gestion_risque_residuelle AS 'Gestion du risque résiduel'
FROM U_scenario_operationnel,T_chemin_d_attaque_strategique, X_revaluation_du_risque, ZB_comporter_2, Y_mesure, UA_ER, M_evenement_redoute
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = X_revaluation_du_risque.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = UA_ER.id_chemin_d_attaque_strategique
AND ZB_comporter_2.id_mesure = Y_mesure.id_mesure
AND UA_ER.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
AND U_scenario_operationnel.id_projet = $getid_projet";
/*"SELECT
X_revaluation_du_risque.nom_risque_residuelle,
X_revaluation_du_risque.gestion_risque_residuelle,
X_revaluation_du_risque.risque_residuel,
X_revaluation_du_risque.gestion_risque_residuelle,
X_revaluation_du_risque.vraisemblance_residuelle,
X_revaluation_du_risque.description_risque_residuelle,
M_evenement_redoute.nom_evenement_redoute,
U_scenario_operationnel.id_risque,M_evenement_redoute.niveau_de_gravite,
Y_mesure.nom_mesure,
U_scenario_operationnel.vraisemblance
FROM  X_revaluation_du_risque, M_evenement_redoute, U_scenario_operationnel, Y_mesure
WHERE U_scenario_operationnel.id_projet = $getid_projet";*/

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
