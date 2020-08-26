<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
header('Content-Type: application/json');

include("../bdd/connexion_sqli.php");

$query_interne3a = "SELECT * FROM R_partie_prenante WHERE type = 'Interne' AND id_projet = $getid_projet ORDER BY id_partie_prenante";
$query_externe3a = "SELECT * FROM R_partie_prenante WHERE type = 'Externe' AND id_projet = $getid_projet ORDER BY id_partie_prenante";
$query_interne3c = "SELECT * FROM R_partie_prenante WHERE type = 'Interne' AND id_projet = $getid_projet ORDER BY id_partie_prenante";
$query_externe3c = "SELECT * FROM R_partie_prenante WHERE type = 'Externe' AND id_projet = $getid_projet ORDER BY id_partie_prenante";
$query_seuil = "SELECT id_seuil, seuil_danger, seuil_controle, seuil_veille, id_projet, id_atelier FROM Q_seuil WHERE id_projet = $getid_projet ORDER BY id_seuil";




$result_interne3a = mysqli_query($connect, $query_interne3a);
$result_externe3a = mysqli_query($connect, $query_externe3a);
$result_interne3c = mysqli_query($connect, $query_interne3c);
$result_externe3c = mysqli_query($connect, $query_externe3c);
$result_seuil = mysqli_query($connect, $query_seuil);


$bool_result_interne3a = (mysqli_fetch_array($result_interne3a) != null);
$bool_result_externe3a = (mysqli_fetch_array($result_externe3a) != null);
$bool_result_interne3c = (mysqli_fetch_array($result_interne3c) != null);
$bool_result_externe3c = (mysqli_fetch_array($result_externe3c) != null);


if ($bool_result_interne3a) {

  $data_interne3a = array();
  foreach ($result_interne3a as $row) {
    $menace = $row['niveau_de_menace_partie_prenante'];
    $exposition = ($row['dependance_partie_prenante'] * $row['ponderation_dependance'] * $row['penetration_partie_prenante'] * $row['ponderation_penetration']);
    $fiabilite = ($row['maturite_partie_prenante']  * $row['ponderation_maturite'] * $row['confiance_partie_prenante'] * $row['ponderation_confiance']);
    $nom_partie_prenante = $row['nom_partie_prenante'];

    $data_interne3a[] = array(
      "menace" => $menace,
      "exposition" => $exposition,
      "fiabilite" => $fiabilite,
      "nom_partie_prenante" => $nom_partie_prenante
    );
  }
}
if ($bool_result_externe3a) {
  $data_externe3a = array();
  foreach ($result_externe3a as $row) {
    $menace = $row['niveau_de_menace_partie_prenante'];
    $exposition = ($row['dependance_partie_prenante'] * $row['ponderation_dependance'] * $row['penetration_partie_prenante'] * $row['ponderation_penetration']);
    $fiabilite = ($row['maturite_partie_prenante']  * $row['ponderation_maturite'] * $row['confiance_partie_prenante'] * $row['ponderation_confiance']);
    $nom_partie_prenante = $row["nom_partie_prenante"];

    $data_externe3a[] = array(
      "menace" => $menace,
      "exposition" => $exposition,
      "fiabilite" => $fiabilite,
      "nom_partie_prenante" => $nom_partie_prenante
    );
  }
}

if ($bool_result_interne3c) {
  $array_menace_interne = array();
  $array_exposition_interne = array();
  $array_fiabilite_interne = array();

  foreach ($result_interne3c as $row) {
    $menace = $row['niveau_de_menace_residuelle'];
    $exposition = ($row['dependance_residuelle'] * $row['penetration_residuelle']);
    $fiabilite = ($row['maturite_residuelle'] * $row['confiance_residuelle']);
    $nom_partie_prenante = $row["nom_partie_prenante"];

    // $array_menace_interne[] = $menace;
    // $array_exposition_interne[] = $exposition;
    // $array_fiabilite_interne[] = $fiabilite;
  
    // $menace_interne_residuelle = max($array_menace_interne);
    // $exposition_interne_residuelle = max($array_exposition_interne);
    // $fiabilite_interne_residuelle = min($array_fiabilite_interne);

    $data_interne3c[] = array(
      "menace_interne_residuelle" => $menace,
      "exposition_interne_residuelle" => $exposition,
      "fiabilite_interne_residuelle" => $fiabilite,
      "nom_partie_prenante" => $nom_partie_prenante
    );
  }
}

if ($bool_result_externe3c) {
  $array_menace_externe = array();
  $array_exposition_externe = array();
  $array_fiabilite_externe = array();

  foreach ($result_externe3c as $row) {
    $menace = $row['niveau_de_menace_residuelle'];
    $exposition = ($row['dependance_residuelle'] * $row['penetration_residuelle']);
    $fiabilite = ($row['maturite_residuelle'] * $row['confiance_residuelle']);
    $nom_partie_prenante = $row["nom_partie_prenante"];

    // $array_menace_externe[] = $menace;
    // $array_exposition_externe[] = $exposition;
    // $array_fiabilite_externe[] = $fiabilite;
  
    // $menace_externe_residuelle = max($array_menace_externe);
    // $exposition_externe_residuelle = max($array_exposition_externe);
    // $fiabilite_externe_residuelle = min($array_fiabilite_externe);

    $data_externe3c[] = array(
      "menace_externe_residuelle" => $menace,
      "exposition_externe_residuelle" => $exposition,
      "fiabilite_externe_residuelle" => $fiabilite,
      "nom_partie_prenante" => $nom_partie_prenante
    );
  }
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

$data = array();
if ($bool_result_interne3a) {
  $data["data_interne3a"] = $data_interne3a;
};
if ($bool_result_externe3a) {
  $data["data_externe3a"] = $data_externe3a;
};
if ($bool_result_interne3c) {
  $data["data_interne3c"] = $data_interne3c;
};
if ($bool_result_externe3c) {
  $data["data_externe3c"] = $data_externe3c;
};
$data["data_seuil"] = $data_seuil;

mysqli_close($connect);

echo json_encode($data);
