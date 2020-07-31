<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
header('Content-Type: application/json');
include("content/php/bdd/connexion_sqli.php");

$query_dimension = "SELECT DA_echelle.echelle_vraisemblance, DA_echelle.echelle_gravite 
FROM DA_echelle, F_projet 
WHERE id_projet = $getid_projet AND F_projet.id_echelle = DA_echelle.id_echelle";
// print $query_dimension;//5 4 
// print '<br>';
$exec_dimension = mysqli_query($connect, $query_dimension);
// var_dump($exec_dimension);
$result_dimension = mysqli_fetch_array($exec_dimension);
// print_r($result_dimension);



$query = "SELECT X_revaluation_du_risque.vraisemblance_residuelle, M_evenement_redoute.niveau_de_gravite, T_chemin_d_attaque_strategique.id_risque
FROM X_revaluation_du_risque INNER JOIN T_chemin_d_attaque_strategique ON X_revaluation_du_risque.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique INNER JOIN S_scenario_strategique ON T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique  INNER JOIN M_evenement_redoute ON S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
WHERE M_evenement_redoute.id_projet = $getid_projet
AND S_scenario_strategique.id_projet = $getid_projet
AND X_revaluation_du_risque.id_projet = $getid_projet";
// print $query; // 2 1 a
$result = mysqli_query($connect, $query);
// print_r($result);



$query_exist_bareme = "SELECT id_bareme_risque, vraisemblance, gravite, bareme FROM DB_bareme_risque WHERE id_projet = $getid_projet";
// print $query_exist_bareme;
$exec_exist_bareme = mysqli_query($connect, $query_exist_bareme);
// print_r($exec_exist_bareme);
$result_exist_bareme = mysqli_fetch_array($exec_exist_bareme);
// var_dump($result_exist_bareme);
$bool_exist = ($result_exist_bareme != NULL);
// print 'bool_exist : ';
// var_dump($bool_exist);

if ($bool_exist) {
  // print 'bonjour';
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







$data_dim = array();
$echelle_vraisemblance = $result_dimension['echelle_vraisemblance'];
$echelle_gravite = $result_dimension['echelle_gravite'];

$data_dim[] = array(
  "echelle_vraisemblance" => $echelle_vraisemblance,
  "echelle_gravite" => $echelle_gravite,
);

// print_r($data_dim);


$data_cell = array();
foreach ($result as $row) {
  $vraisemblance = $row['vraisemblance_residuelle'];
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
if ($bool_exist) {
  $data['bareme_exist'] = $data_bareme;
}

mysqli_close($connect);

echo json_encode($data);
