<?php

header('Content-Type: application/json');

include("../bdd/connexion_sqli.php");

$query_interne3a = "SELECT id_partie_prenante,dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM partie_prenante WHERE type = 'Interne' ORDER BY id_partie_prenante";
$query_externe3a = "SELECT id_partie_prenante,dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM partie_prenante WHERE type = 'Externe' ORDER BY id_partie_prenante";
$query_interne3c = "SELECT dependance_residuelle,penetration_residuelle, maturite_residuelle, confiance_residuelle, dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM chemin_d_attaque_strategique, scenario_strategique, partie_prenante WHERE chemin_d_attaque_strategique.id_scenario_strategique = scenario_strategique.id_scenario_strategique AND scenario_strategique.id_partie_prenante = partie_prenante.id_partie_prenante AND partie_prenante.type = 'Interne'";
$query_externe3c = "SELECT dependance_residuelle,penetration_residuelle, maturite_residuelle, confiance_residuelle, dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM chemin_d_attaque_strategique, scenario_strategique, partie_prenante WHERE chemin_d_attaque_strategique.id_scenario_strategique = scenario_strategique.id_scenario_strategique AND scenario_strategique.id_partie_prenante = partie_prenante.id_partie_prenante AND partie_prenante.type = 'Externe'";

$result_interne3a = mysqli_query($connect, $query_interne3a);
$result_externe3a = mysqli_query($connect, $query_externe3a);
$result_interne3c = mysqli_query($connect, $query_interne3c);
$result_externe3c = mysqli_query($connect, $query_externe3c);


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





$array_menace_interne = array();
$array_exposition_interne = array();
$array_fiabilite_interne = array();

foreach ($result_interne3c as $row) {
  $menace = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']) / ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
  $exposition = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']);
  $fiabilite = ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);

  $array_menace_interne[] = $menace;
  $array_exposition_interne[] = $exposition;
  $array_fiabilite_interne[] = $fiabilite;
}
$menace_interne_residuelle = max($array_menace_interne);
$exposition_interne_residuelle = max($array_exposition_interne);
$fiabilite_interne_residuelle = min($array_fiabilite_interne);

$data_interne3c[] = array(
  "menace_interne_residuelle" => $menace_interne_residuelle,
  "exposition_interne_residuelle" => $exposition_interne_residuelle,
  "fiabilite_interne_residuelle" => $fiabilite_interne_residuelle
);



$array_menace_externe = array();
$array_exposition_externe = array();
$array_fiabilite_externe = array();

foreach ($result_externe3c as $row) {
  $menace = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']) / ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
  $exposition = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']);
  $fiabilite = ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);

  $array_menace_externe[] = $menace;
  $array_exposition_externe[] = $exposition;
  $array_fiabilite_externe[] = $fiabilite;
}
$menace_externe_residuelle = max($array_menace_externe);
$exposition_externe_residuelle = max($array_exposition_externe);
$fiabilite_externe_residuelle = min($array_fiabilite_externe);

$data_externe3c[] = array(
  "menace_externe_residuelle" => $menace_externe_residuelle,
  "exposition_externe_residuelle" => $exposition_externe_residuelle,
  "fiabilite_externe_residuelle" => $fiabilite_externe_residuelle
);




$data = array(
  'data_interne3a' => $data_interne3a,
  'data_externe3a' => $data_externe3a,
  'data_interne3c' => $data_interne3c,
  'data_externe3c' => $data_externe3c,
);

mysqli_close($connect);

echo json_encode($data);
