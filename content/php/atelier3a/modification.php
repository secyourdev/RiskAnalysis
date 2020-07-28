<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);


$categorie_partie_prenante = mysqli_real_escape_string($connect, $input['categorie_partie_prenante']);
$nom_partie_prenante = mysqli_real_escape_string($connect, $input['nom_partie_prenante']);
$type = mysqli_real_escape_string($connect, $input['type']);
$dependance_partie_prenante = mysqli_real_escape_string($connect, $input['dependance_partie_prenante']);
$penetration_partie_prenante = mysqli_real_escape_string($connect, $input['penetration_partie_prenante']);
$maturite_partie_prenante = mysqli_real_escape_string($connect, $input['maturite_partie_prenante']);
$confiance_partie_prenante = mysqli_real_escape_string($connect, $input['confiance_partie_prenante']);

$ponderation_dependance = mysqli_real_escape_string($connect, $input['ponderation_dependance']);
$ponderation_penetration = mysqli_real_escape_string($connect, $input['ponderation_penetration']);
$ponderation_maturite = mysqli_real_escape_string($connect, $input['ponderation_maturite']);
$ponderation_confiance = mysqli_real_escape_string($connect, $input['ponderation_confiance']);
$niveau_de_menace_partie_prenante = round(($dependance_partie_prenante*$ponderation_dependance * $penetration_partie_prenante*$ponderation_penetration) / ($maturite_partie_prenante*$ponderation_maturite * $confiance_partie_prenante*$ponderation_confiance), 2);

$id_atelier = '3.a';

$results["error"] = false;

// Verification du categorie_partie_prenante
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-./:,'"]{1,100}$/", $categorie_partie_prenante)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "categorie_partie_prenante invalide";
}
// Verification du nom_partie_prenante
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-./:,'"]{1,100}$/", $nom_partie_prenante)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "nom_partie_prenante invalide";
}
// Verification du type
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-./:,'"]{1,100}$/", $type)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "type invalide";
}
// Verification du dependance_partie_prenante
if (!preg_match("/^([0-4])$/", $dependance_partie_prenante)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "dependance_partie_prenante invalide";
}
// Verification du penetration_partie_prenante
if (!preg_match("/^([0-4])$/", $penetration_partie_prenante)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "penetration_partie_prenante invalide";
}
// Verification du maturite_partie_prenante
if (!preg_match("/^([0-4])$/", $maturite_partie_prenante)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "maturite_partie_prenante invalide";
}
// Verification du confiance_partie_prenante
if (!preg_match("/^([0-4])$/", $confiance_partie_prenante)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "confiance_partie_prenante invalide";
}
// Verification du ponderation_dependance
if (!preg_match("/^([0-9]|1[0-6])$/", $ponderation_dependance)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "ponderation_dependance invalide";
}
// Verification du ponderation_penetration
if (!preg_match("/^([0-9]|1[0-6])$/", $ponderation_penetration)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "ponderation_penetration invalide";
}
// Verification du ponderation_maturite
if (!preg_match("/^([0-9]|1[0-6])$/", $ponderation_maturite)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "ponderation_maturite invalide";
}
// Verification du ponderation_confiance
if (!preg_match("/^([0-9]|1[0-6])$/", $ponderation_confiance)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "ponderation_confiance invalide";
}
// // Verification du niveau_de_menace_partie_prenante
// if (!preg_match("/^([0-9]|1[0-6])$/", $niveau_de_menace_partie_prenante)) {
//     $results["error"] = true;
//     $_SESSION['message_error_2'] = "niveau_de_menace_partie_prenante invalide";
// }





if ($input["action"] === 'edit' && $results["error"] === false) {
    $query =
        "UPDATE R_partie_prenante 
    SET 
    categorie_partie_prenante = '" . $categorie_partie_prenante . "',
    nom_partie_prenante = '" . $nom_partie_prenante . "',
    type = '" . $type . "',
    dependance_partie_prenante = '" . $dependance_partie_prenante . "',
    ponderation_dependance = $ponderation_dependance,
    penetration_partie_prenante = '" . $penetration_partie_prenante . "',
    ponderation_penetration = $ponderation_penetration,
    maturite_partie_prenante = '" . $maturite_partie_prenante . "',
    ponderation_maturite = $ponderation_maturite,
    confiance_partie_prenante = '" . $confiance_partie_prenante . "',
    ponderation_confiance = $ponderation_confiance,
    niveau_de_menace_partie_prenante = '" . $niveau_de_menace_partie_prenante . "'
    WHERE id_partie_prenante = '" . $input["id_partie_prenante"] . "'
    AND id_projet = $getid_projet
    AND id_atelier = '$id_atelier'
    ";

    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = 
    "DELETE FROM R_partie_prenante 
    WHERE id_partie_prenante = '" . $input["id_partie_prenante"] . "'
    AND id_projet = $getid_projet
    AND id_atelier = '$id_atelier'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
