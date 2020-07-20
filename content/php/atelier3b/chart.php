<?php

header('Content-Type: application/json');

include("../bdd/connexion_sqli.php");

$query_interne = "SELECT id_partie_prenante,dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM partie_prenante WHERE type = 'Interne' ORDER BY id_partie_prenante";
$query_externe = "SELECT id_partie_prenante,dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM partie_prenante WHERE type = 'Externe' ORDER BY id_partie_prenante";

$result_interne = mysqli_query($connect, $query_interne);
$result_externe = mysqli_query($connect, $query_externe);

$data_externe = array();
foreach ($result_externe as $row) {
  $menace = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']) / ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
  $exposition = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']);
  $fiabilite = ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);

  $data_externe[] = array(
    "menace" => $menace,
    "exposition" => $exposition,
    "fiabilite" => $fiabilite
  );
}

$data_interne = array();
foreach ($result_interne as $row) {
  $menace = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']) / ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
  $exposition = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']);
  $fiabilite = ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);

  $data_interne[] = array(
    "menace" => $menace,
    "exposition" => $exposition,
    "fiabilite" => $fiabilite
  );
}


$data = array(
  'data_interne' => $data_interne,
  'data_externe' => $data_externe,
);

mysqli_close($connect);

echo json_encode($data);
