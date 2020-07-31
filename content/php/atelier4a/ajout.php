<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$idscenar = $_POST['nomscenar'];
$modeope = $_POST['modeope'];
$id_mode_operatoire = "id_mode_operatoire";

$insere = $bdd->prepare('INSERT INTO `W_mode_operatoire`(`id_mode_operatoire`, `mode_operatoire`, `id_scenario_operationnel`) VALUES (?,?,?)');

// Verification du mode operatoire
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $modeope)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "Mode opératoire invalide";
}

if ($results["error"] === false && isset($_POST['validerope'])) {
  $insere->bindParam(1, $id_mode_operatoire);
  $insere->bindParam(2, $modeope);
  $insere->bindParam(3, $idscenar);
  $insere->execute();
  $_SESSION['message_success_2'] = "Le mode opératoire a bien été ajoutée !";
}

header('Location: ../../../atelier-4a&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#mode_operatoire');
?>