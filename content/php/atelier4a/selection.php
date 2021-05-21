<?php

// $getid_projet = intval($_GET['id_projet']);

// $getid_projet = intval($_GET['id_projet']);

$getid_projet = $_SESSION['id_projet'];
include("content/php/bdd/connexion_sqli.php");
$query1 = "SELECT DISTINCT
T_chemin_d_attaque_strategique.id_risque,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
S_scenario_strategique.id_scenario_strategique,
S_scenario_strategique.nom_scenario_strategique,
M_evenement_redoute.nom_evenement_redoute,
M_evenement_redoute.niveau_de_gravite,
P_SROV.description_source_de_risque,
P_SROV.objectif_vise
FROM S_scenario_strategique, T_chemin_d_attaque_strategique, UA_ER, M_evenement_redoute, P_SROV
WHERE T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = UA_ER.id_chemin_d_attaque_strategique
AND UA_ER.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
AND S_scenario_strategique.id_source_de_risque = P_SROV.id_source_de_risque
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet
ORDER BY T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique ASC";

$query2 = "SELECT
U_scenario_operationnel.id_scenario_operationnel,
T_chemin_d_attaque_strategique.id_risque,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
U_scenario_operationnel.description_scenario_operationnel
FROM U_scenario_operationnel,T_chemin_d_attaque_strategique
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND U_scenario_operationnel.id_projet = $getid_projet
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet";
$query3 = "SELECT * FROM U_scenario_operationnel WHERE id_projet = $getid_projet";
$query4 = "SELECT * FROM W_mode_operatoire INNER JOIN U_scenario_operationnel
ON W_mode_operatoire.id_scenario_operationnel = U_scenario_operationnel.id_scenario_operationnel WHERE U_scenario_operationnel.id_projet = $getid_projet";
$queryprojet = "SELECT echelle_vraisemblance FROM F_projet NATURAL JOIN DA_echelle WHERE F_projet.id_projet = $getid_projet";

$result1 = mysqli_query($connect, $query1);
$result2 = mysqli_query($connect, $query2);
$result3 = mysqli_query($connect, $query3);
$result4 = mysqli_query($connect, $query4);
$resultprojet = mysqli_query($connect, $queryprojet);

// browse image
$query = "SELECT * FROM U_scenario_operationnel WHERE id_projet = $getid_projet";
$result = mysqli_query($connect, $query);
$query_scenario_op = "SELECT id_scenario_operationnel, description_scenario_operationnel FROM U_scenario_operationnel WHERE id_projet = $getid_projet AND id_atelier = '4.a'";
$result_scenario_op = mysqli_query($connect, $query_scenario_op);
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$rq_scen_strat= "SELECT nom_scenario_strategique AS 'Nom du scnénario stratégique',description_source_de_risque AS 'Description source de risque',objectif_vise AS 'Objectifs visés',nom_evenement_redoute AS 'Événements redoutés',id_risque AS 'N° Risque',nom_chemin_d_attaque_strategique AS 'Chemin d''attaques stratégiques',niveau_de_gravite AS 'Gravité' FROM S_scenario_strategique NATURAL JOIN P_SROV NATURAL JOIN M_evenement_redoute NATURAL JOIN T_chemin_d_attaque_strategique WHERE id_projet = $getid_projet AND id_atelier = '4.a'";

$rq_mode_op= "SELECT nom_scenario_operationnel AS'Scénario opérationnel', description_scenario_operationnel AS 'Mode opératoire' FROM U_scenario_operationnel WHERE id_projet = $getid_projet AND id_atelier = '4.a'";

$rq_scen_strat_tab = mysqli_query($connect, $rq_scen_strat);
$rq_mode_op_tab= mysqli_query($connect, $rq_mode_op);
?>
