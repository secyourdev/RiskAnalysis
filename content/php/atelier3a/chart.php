<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
header('Content-Type: application/json');

include("../bdd/connexion_sqli.php");

$query_interne = "SELECT id_partie_prenante,nom_partie_prenante, dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM R_partie_prenante WHERE type = 'Interne' AND id_projet = $getid_projet ORDER BY id_partie_prenante";
$query_externe = "SELECT id_partie_prenante,nom_partie_prenante, dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM R_partie_prenante WHERE type = 'Externe' AND id_projet = $getid_projet ORDER BY id_partie_prenante";
$query_seuil = "SELECT id_seuil, seuil_danger, seuil_controle, seuil_veille, id_projet, id_atelier FROM Q_seuil WHERE id_projet = $getid_projet ORDER BY id_seuil";

$result_interne = mysqli_query($connect, $query_interne);
$result_externe = mysqli_query($connect, $query_externe);
$result_seuil = mysqli_query($connect, $query_seuil);

$data_interne = array();
foreach ($result_interne as $row) {
  $menace = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']) / ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
  $exposition = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']);
  $fiabilite = ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
  $nom_partie_prenante = $row['nom_partie_prenante'];

  $data_interne[] = array(
    "menace" => $menace,
    "exposition" => $exposition,
    "fiabilite" => $fiabilite,
    "nom_partie_prenante" => $nom_partie_prenante
  );
}

$data_externe = array();
foreach ($result_externe as $row) {
  $menace = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']) / ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
  $exposition = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']);
  $fiabilite = ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
  $nom_partie_prenante = $row["nom_partie_prenante"];

  $data_externe[] = array(
    "menace" => $menace,
    "exposition" => $exposition,
    "fiabilite" => $fiabilite,
    "nom_partie_prenante" => $nom_partie_prenante
  );
}

$data_seuil = array();
foreach ($result_seuil as $row) {
  $seuil_danger = intval($row['seuil_danger']);
  $seuil_controle = intval($row['seuil_controle']);
  $seuil_veille = intval($row['seuil_veille']);

  $data_seuil[] = array(
    "seuil_danger" => $seuil_danger,
    "seuil_controle" => $seuil_controle,
    "seuil_veille" => $seuil_veille
  );
}


$data = array(
  'data_interne' => $data_interne,
  'data_externe' => $data_externe,
  'data_seuil' => $data_seuil
);

mysqli_close($connect);

echo json_encode($data);
