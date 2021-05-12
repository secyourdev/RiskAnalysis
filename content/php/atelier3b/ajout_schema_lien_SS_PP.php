<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_scenario_strategique = htmlspecialchars($_POST['id_scenario_strategique']);
$id_partie_prenante = htmlspecialchars($_POST['id_partie_prenante']);

// Verification de la scenario strategique
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Scenario strategique invalide";
}

// Verification de la partie prenante
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_partie_prenante)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Partie prenante invalide";
  }
 
$insere = $bdd->prepare("INSERT INTO ZE_SS_PP (id_scenario_strategique,id_partie_prenante) VALUES (?,?)");

if (isset($id_scenario_strategique)&&isset($id_partie_prenante)) {
    $insere->bindParam(1, $id_scenario_strategique);
    $insere->bindParam(2, $id_partie_prenante);
    $insere->execute();
}
?>