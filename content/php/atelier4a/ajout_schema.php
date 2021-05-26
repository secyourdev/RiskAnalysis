<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_scenario_operationnel = $_POST['id_scenario_operationnel'];
$schema = $_POST['schema'];


// Verification du id_scenario_operationnel
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_operationnel)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Identifiant scénario invalide";
}
 
$insere = $bdd->prepare("UPDATE U_scenario_operationnel SET images = ? WHERE id_projet = ? AND id_atelier = '4.a' AND id_scenario_operationnel = ?");

if (isset($id_scenario_operationnel)) {
    $insere->bindParam(1, $schema);
    $insere->bindParam(2, $get_id_projet);
    $insere->bindParam(3, $id_scenario_operationnel);
    $insere->execute();
}
?>