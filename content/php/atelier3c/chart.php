<?php

header('Content-Type: application/json');

include("../bdd/connexion_sqli.php");

$query_interne3a = "SELECT id_partie_prenante,dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM partie_prenante WHERE type = 'Interne3a' ORDER BY id_partie_prenante";
$query_externe3a = "SELECT id_partie_prenante,dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM partie_prenante WHERE type = 'Externe3a' ORDER BY id_partie_prenante";
$query_interne3c = "SELECT dependance_residuelle,penetration_residuelle, maturite_residuelle, confiance_residuelle, dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM chemin_d_attaque_strategique, scenario_strategique, partie_prenante WHERE chemin_d_attaque_strategique.id_scenario_strategique = scenario_strategique.id_scenario_strategique AND scenario_strategique.id_partie_prenante = partie_prenante.id_partie_prenante AND partie_prenante.type = 'Interne'";
$query_externe3c = "SELECT id_partie_prenante,dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM partie_prenante WHERE type = 'Externe3a' ORDER BY id_partie_prenante";

$result_interne3a = mysqli_query($connect, $query_interne3a);
$result_externe3a = mysqli_query($connect, $query_externe3a);
$result_interne3c = mysqli_query($connect, $query_interne3a);
$result_externe3c = mysqli_query($connect, $query_externe3a);

$data_externe3a = array();
foreach ($result_externe3a as $row) {
  $menace = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']) / ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
  $exposition = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']);
  $fiabilite = ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);

  $data_externe3a[] = array(
    "menace" => $menace,
    "exposition" => $exposition,
    "fiabilite" => $fiabilite
  );
}

$data_interne3a = array();
foreach ($result_interne3a as $row) {
  $menace = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']) / ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
  $exposition = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']);
  $fiabilite = ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);

  $data_interne3a[] = array(
    "menace" => $menace,
    "exposition" => $exposition,
    "fiabilite" => $fiabilite
  );
}


$data = array(
  'data_interne3a' => $data_interne3a,
  'data_externe3a' => $data_externe3a,
);

mysqli_close($connect);

echo json_encode($data);
