<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_fleche = $_POST['id_fleche'];
$valeur_chemin = $_POST['valeur_chemin'];
$id_scenario_strategique = $_POST['id_scenario_strategique'];
$id_source = $_POST['id_source'];
$id_schema_source = $_POST['id_schema_source'];
$id_destination = $_POST['id_destination'];
$id_schema_destination = $_POST['id_schema_destination'];

// Verification de l'ID flèche
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-\_.:,'\"–]{0,100}$/", $id_fleche)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Identifiant flèche invalide";
}

// Verification du valeur chemin
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $valeur_chemin)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Valeur chemin invalide";
}

// Verification de l'id scénario
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant scénario invalide";
}

// Verification de l'id source
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_source)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant source invalide";
}

// Verification de l'id schema source
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-\_.:,'\"–]{0,100}$/", $id_schema_source)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant Schéma Source invalide";
}

// Verification de l'id destination
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_destination)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant destination invalide";
}

// Verification de l'id schema destination
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-\_.:,'\"–]{0,100}$/", $id_schema_destination)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant Schéma Destination invalide";
}

//ajout des EI dans la base de données
$insere = $bdd->prepare("INSERT INTO TA_EI (id_fleche,valeur_chemin,id_scenario_strategique,id_source,id_schema_source,id_destination,id_schema_destination,id_projet,id_atelier) VALUES (?,?,?,?,?,?,?,?,?)");

if (isset($id_fleche)&&isset($valeur_chemin)&&isset($id_scenario_strategique)&&isset($id_source)&&isset($id_schema_source)&&isset($id_destination)&&isset($id_schema_destination)&&isset($get_id_projet)&&isset($id_atelier)&&$results["error"]!=true) {
    $insere->bindParam(1, $id_fleche);
    $insere->bindParam(2, $valeur_chemin);
    $insere->bindParam(3, $id_scenario_strategique);
    $insere->bindParam(4, $id_source);
    $insere->bindParam(5, $id_schema_source);
    $insere->bindParam(6, $id_destination);
    $insere->bindParam(7, $id_schema_destination);
    $insere->bindParam(8, $get_id_projet);
    $insere->bindParam(9, $id_atelier);
    $insere->execute();

    $results["error"] = false;
    $_SESSION['message_success'] = "Votre schéma a été correctement mise à jour !";
}
?>