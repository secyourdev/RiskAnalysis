<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_fleche = htmlspecialchars($_POST['id_fleche']);
$id_scenario_strategique = htmlspecialchars($_POST['id_scenario_strategique']);


// Verification de l'id flèche
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_fleche)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "ID Flèche invalide";
}

// Verification de l'id scenario strategique
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "ID Scénario stratégique invalide";
}

$suppression = $bdd->prepare("DELETE FROM TA_EI_ER WHERE id_fleche=? AND id_scenario_strategique=? AND id_projet=? AND id_atelier=?");

if (isset($id_fleche)&&isset($id_scenario_strategique)){
    $suppression->bindParam(1, $id_fleche);
    $suppression->bindParam(2, $id_scenario_strategique);
    $suppression->bindParam(3, $get_id_projet);
    $suppression->bindParam(4, $id_atelier);
    $suppression->execute();
}
?>