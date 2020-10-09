<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_scenario_strategique = $_POST['id_scenario_strategique'];
$schema = $_POST['schema'];


// Verification du id_scénario
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "Identifiant scénario invalide";
}

// Verification du schéma
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.;:,'\"–+]{0,100}$/", $schema)) {
    $results["error"] = true;
    $_SESSION['message_error_2'] = "Schéma invalide";
}
  
$insere = $bdd->prepare("UPDATE S_scenario_strategique SET image = ? WHERE id_projet = ? AND id_atelier = '3.b' AND id_scenario_strategique = ?");

if (isset($id_scenario_strategique)) {
    $insere->bindParam(1, $schema);
    $insere->bindParam(2, $get_id_projet);
    $insere->bindParam(3, $id_scenario_strategique);
    $insere->execute();
}

//header('Location: ../../../atelier-3b&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet'] . '#chemin_dattaque');
?>