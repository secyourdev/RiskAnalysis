<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
include("content/php/bdd/connexion_sqli.php");

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
$niveau_de_menace_partie_prenante = ($dependance_partie_prenante*$ponderation_dependance * $penetration_partie_prenante*$ponderation_penetration) / ($maturite_partie_prenante*$ponderation_maturite * $confiance_partie_prenante*$ponderation_confiance);

$id_atelier = '3.a';

$results["error"] = false;

if ($input["action"] === 'edit' && $results["error"] === false) {
    $query =
        "UPDATE partie_prenante 
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
    "DELETE FROM partie_prenante 
    WHERE id_partie_prenante = '" . $input["id_partie_prenante"] . "'
    AND id_projet = $getid_projet
    AND id_atelier = $id_atelier
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
