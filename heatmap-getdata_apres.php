<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
header('Content-Type: application/json');
include("content/php/bdd/connexion_sqli.php");

$query_dimension = "SELECT DA_echelle.echelle_vraisemblance, DA_echelle.echelle_gravite 
FROM DA_echelle, F_projet 
WHERE F_projet.id_projet = $getid_projet AND F_projet.id_echelle = DA_echelle.id_echelle";

$exec_dimension = mysqli_query($connect, $query_dimension);

$result_dimension = mysqli_fetch_array($exec_dimension);

// Récupérer le nombre de niveau de vraisemblance 
$query_nb_niveau_vraisemblance = "SELECT `nb_niveau_echelle` FROM `F_projet` INNER JOIN DC_echelle_vraisemblance ON DC_echelle_vraisemblance.id_echelle = id_echelle_vraisemblance WHERE F_projet.id_projet = $getid_projet ";
$exec_nb_niveau_vraisemblance = mysqli_query($connect, $query_nb_niveau_vraisemblance);
$result_nb_niveau_vraisemblance = mysqli_fetch_array($exec_nb_niveau_vraisemblance);


<<<<<<< HEAD
$query = "SELECT X_revaluation_du_risque.vraisemblance_residuelle, M_evenement_redoute.niveau_de_gravite, T_chemin_d_attaque_strategique.id_risque
FROM X_revaluation_du_risque INNER JOIN T_chemin_d_attaque_strategique ON X_revaluation_du_risque.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique INNER JOIN S_scenario_strategique ON T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique  INNER JOIN M_evenement_redoute ON S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
WHERE M_evenement_redoute.id_projet = $getid_projet
AND S_scenario_strategique.id_projet = $getid_projet
AND X_revaluation_du_risque.id_projet = $getid_projet";

$result = mysqli_query($connect, $query);



=======

// récupérer les risques initiaux
$query_risque_initial = "SELECT U_scenario_operationnel.vraisemblance, M_evenement_redoute.niveau_de_gravite, T_chemin_d_attaque_strategique.id_risque
FROM U_scenario_operationnel, UA_ER, T_chemin_d_attaque_strategique, M_evenement_redoute
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique 
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = UA_ER.id_chemin_d_attaque_strategique
AND UA_ER.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
AND U_scenario_operationnel.id_projet = $getid_projet
AND UA_ER.id_projet = $getid_projet
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet
AND M_evenement_redoute.id_projet = $getid_projet";

$result_risque_initial = mysqli_query($connect, $query_risque_initial);


// Récupérer les risques résidueles
$query_risque_residuel = "SELECT DISTINCT 
T_chemin_d_attaque_strategique.id_risque,
X_revaluation_du_risque.vraisemblance_residuelle,
M_evenement_redoute.niveau_de_gravite
FROM U_scenario_operationnel,T_chemin_d_attaque_strategique, X_revaluation_du_risque, ZB_comporter_2, Y_mesure, UA_ER, M_evenement_redoute
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = X_revaluation_du_risque.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = UA_ER.id_chemin_d_attaque_strategique
AND ZB_comporter_2.id_mesure = Y_mesure.id_mesure
AND UA_ER.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
AND U_scenario_operationnel.id_projet = $getid_projet";

$result_risque_residuel = mysqli_query($connect, $query_risque_residuel);
>>>>>>> origin/Carlos

$query_exist_bareme = "SELECT id_bareme_risque, vraisemblance, gravite, bareme FROM DB_bareme_risque WHERE id_projet = $getid_projet";

$exec_exist_bareme = mysqli_query($connect, $query_exist_bareme);

$result_exist_bareme = mysqli_fetch_array($exec_exist_bareme);

$bool_exist = ($result_exist_bareme != NULL);


if ($bool_exist) {

  $data_bareme = array();
  foreach ($exec_exist_bareme as $row) {
    $bareme_vraisemblance = $row["vraisemblance"];
    $bareme_gravite = $row["gravite"];
    $bareme_bareme = $row["bareme"];
    $data_bareme[] = array(
      'bareme_vraisemblance' => $bareme_vraisemblance,
      'bareme_gravite' => $bareme_gravite,
      'bareme_bareme' => $bareme_bareme,
    );
  }
}

<<<<<<< HEAD






=======
>>>>>>> origin/Carlos
$data_dim = array();
$echelle_vraisemblance = $result_nb_niveau_vraisemblance['nb_niveau_echelle'];
$echelle_gravite = $result_dimension['echelle_gravite'];

$data_dim[] = array(
  "echelle_vraisemblance" => $echelle_vraisemblance,
  "echelle_gravite" => $echelle_gravite,
);

<<<<<<< HEAD



$data_cell = array();
foreach ($result as $row) {
=======
// récupération des risques résiduels
$data_cell = array();
foreach ($result_risque_residuel as $row) {
>>>>>>> origin/Carlos
  $vraisemblance = $row['vraisemblance_residuelle'];
  $niveau_de_gravite = $row['niveau_de_gravite'];
  $id_risque = $row['id_risque'];

  $data_cell[] = array(
    "vraisemblance" => $vraisemblance,
    "niveau_de_gravite" => $niveau_de_gravite,
    "id_risque" => $id_risque,
  );
}

<<<<<<< HEAD
=======
// Récupération des risques initiaux non modifiés
foreach ($result_risque_initial as $row) {
  // Ajout du risque si pas de risque résiduel déja traitée dans la fonction précedente
  if(array_search($row['id_risque'], array_column($data_cell, 'id_risque')) === false){
    $vraisemblance = $row['vraisemblance'];
    $niveau_de_gravite = $row['niveau_de_gravite'];
    $id_risque = $row['id_risque'];

    $data_cell[] = array(
      "vraisemblance" => $vraisemblance,
      "niveau_de_gravite" => $niveau_de_gravite,
      "id_risque" => $id_risque,
    );
  }
}
>>>>>>> origin/Carlos

$data = array(
  'data_dim' => $data_dim,
  'data_cell' => $data_cell
);
if ($bool_exist) {
  $data['bareme_exist'] = $data_bareme;
}

mysqli_close($connect);

echo json_encode($data);
