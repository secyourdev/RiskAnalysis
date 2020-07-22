<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
header('Content-Type: application/json');

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v22");

// $query = "SELECT U_scenario_operationnel.vraisemblance, M_evenement_redoute.niveau_de_gravite, W_mode_operatoire.mode_operatoire
// FROM W_mode_operatoire, U_scenario_operationnel, T_chemin_d_attaque_strategique, S_scenario_strategique , M_evenement_redoute
// WHERE W_mode_operatoire.id_scenario_operationnel = U_scenario_operationnel.id_scenario_operationnel
// AND U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique 
// AND T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique 
// AND S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute";

$query_dimension = "SELECT D_echelle.echelle_vraisemblance, D_echelle.echelle_gravite FROM D_echelle, F_projet WHERE id_projet = $getid_projet AND F_projet.id_echelle = D_echelle.id_echelle"; 

$query = "SELECT U_scenario_operationnel.vraisemblance, M_evenement_redoute.niveau_de_gravite, T_chemin_d_attaque_strategique.id_risque
FROM U_scenario_operationnel INNER JOIN T_chemin_d_attaque_strategique ON U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique INNER JOIN S_scenario_strategique ON T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique  INNER JOIN M_evenement_redoute ON S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
WHERE M_evenement_redoute.id_projet = $getid_projet
AND S_scenario_strategique.id_projet = $getid_projet
AND U_scenario_operationnel.id_projet = $getid_projet";

// $query_taille_tab = 

$result_dimension = mysqli_query($connect, $query_dimension);
$result = mysqli_query($connect, $query);


$data_dim = array();
foreach ($result_dimension as $row) {
  $echelle_vraisemblance = $row['echelle_vraisemblance'];
  $echelle_gravite = $row['echelle_gravite'];
  
  $data_dim[] = array(
    "echelle_vraisemblance" => $echelle_vraisemblance,
    "echelle_gravite" => $echelle_gravite,
  );
};
// print_r($data_dim);


$data_cell = array();
foreach ($result as $row) {
  $vraisemblance = $row['vraisemblance'];
  $niveau_de_gravite = $row['niveau_de_gravite'];
  $id_risque = $row['id_risque'];

  $data_cell[] = array(
    "vraisemblance" => $vraisemblance,
    "niveau_de_gravite" => $niveau_de_gravite,
    "id_risque" => $id_risque,
  );
}
// print_r($data_cell);

$data = array(
  'data_dim' => $data_dim,
  'data_cell' => $data_cell
);

mysqli_close($connect);

echo json_encode($data);
