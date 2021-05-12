<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_scenario_strategique = htmlspecialchars($_POST['id_scenario_strategique']);
$id_valeur_metier = htmlspecialchars($_POST['id_valeur_metier']);

// Verification de la scenario strategique
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Scenario strategique invalide";
}

// Verification de la valeur métier
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_valeur_metier)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Valeur métier invalide";
  }
 
$insere = $bdd->prepare("INSERT INTO ZF_SS_VM (id_scenario_strategique,id_valeur_metier) VALUES (?,?)");

if (isset($id_scenario_strategique)&&isset($id_valeur_metier)) {
    $insere->bindParam(1, $id_scenario_strategique);
    $insere->bindParam(2, $id_valeur_metier);
    $insere->execute();
}
?>