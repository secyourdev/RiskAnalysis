<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$valeur = $_POST['valeur'];

// Verification de la valeuur
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $valeur)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Valeur invalide";
}
 
$insere = $bdd->prepare("INSERT INTO ZE_schema (valeur) VALUES (?)");

if (isset($valeur)) {
    $insere->bindParam(1, $valeur);
    $insere->execute();
}
?>