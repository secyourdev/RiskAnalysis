<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
header('Content-Type: application/json');

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v22");

$query = "SELECT U_scenario_operationnel.vraisemblance, M_evenement_redoute.niveau_de_gravite, W_mode_operatoire.mode_operatoire
FROM W_mode_operatoire, U_scenario_operationnel, T_chemin_d_attaque_strategique, S_scenario_strategique , M_evenement_redoute
WHERE W_mode_operatoire.id_scenario_operationnel = U_scenario_operationnel.id_scenario_operationnel
AND U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique 
AND T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique 
AND S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute";
// $query = "SELECT U_scenario_operationnel.vraisemblance, M_evenement_redoute.niveau_de_gravite, T_chemin_d_attaque_strategique.id_risque
// FROM W_mode_operatoire, U_scenario_operationnel, T_chemin_d_attaque_strategique, S_scenario_strategique , M_evenement_redoute
// WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique 
// AND T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique 
// AND S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute";


$result = mysqli_query($connect, $query);

$data = array();
foreach ($result as $row) {
  $vraisemblance = $row['vraisemblance'];
  $niveau_de_gravite = $row['niveau_de_gravite'];
  $mode_operatoire = $row['mode_operatoire'];

  $data[] = array(
    "vraisemblance" => $vraisemblance,
    "niveau_de_gravite" => $niveau_de_gravite,
    "mode_operatoire" => $mode_operatoire,
  );
}

mysqli_close($connect);

echo json_encode($data);
