<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
header('Content-Type: application/json');

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");

$query = "SELECT scenario_operationnel.vraisemblance, evenement_redoute.niveau_de_gravite FROM U_scenario_operationnel, M_evenement_redoute, T_chemin_d_attaque_strategique, S_scenario_strategique WHERE scenario_operationnel.id_chemin_d_attaque_strategique = chemin_d_attaque_strategique.id_chemin_d_attaque_strategique AND chemin_d_attaque_strategique.id_scenario_strategique = scenario_strategique.id_scenario_strategique AND scenario_strategique.id_evenement_redoute = evenement_redoute.id_evenement_redoute";
// $query_externe = "SELECT id_partie_prenante,dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM partie_prenante WHERE type = 'Externe' AND id_projet = $getid_projet ORDER BY id_partie_prenante";
// $query_seuil = "SELECT id_seuil, seuil_danger, seuil_controle, seuil_veille, id_projet, id_atelier FROM seuil WHERE id_projet = $getid_projet ORDER BY id_seuil";

$result = mysqli_query($connect, $query);
// $result_externe = mysqli_query($connect, $query_externe);
// $result_seuil = mysqli_query($connect, $query_seuil);

$data = array();
foreach ($result as $row) {
  $vraisemblance = $row['vraisemblance'];
  $niveau_de_gravite = $row['niveau_de_gravite'];

  $data[] = array(
    "vraisemblance" => $vraisemblance,
    "niveau_de_gravite" => $niveau_de_gravite,
  );
}

// $data_externe = array();
// foreach ($result_externe as $row) {
//   $menace = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']) / ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
//   $exposition = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']);
//   $fiabilite = ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);

//   $data_externe[] = array(
//     "menace" => $menace,
//     "exposition" => $exposition,
//     "fiabilite" => $fiabilite
//   );
// }

// $data_seuil = array();
// foreach ($result_seuil as $row) {
//   $seuil_danger = intval($row['seuil_danger']);
//   $seuil_controle = intval($row['seuil_controle']);
//   $seuil_veille = intval($row['seuil_veille']);

//   $data_seuil[] = array(
//     "seuil_danger" => $seuil_danger,
//     "seuil_controle" => $seuil_controle,
//     "seuil_veille" => $seuil_veille
//   );
// }


// $data = array(
//   'data' => $data,
//   // 'data_externe' => $data_externe,
//   // 'data_seuil' => $data_seuil
// );

mysqli_close($connect);

echo json_encode($data);
