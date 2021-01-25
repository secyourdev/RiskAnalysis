<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_source_de_risque = htmlspecialchars($_POST['id_source_de_risque']);
$id_fleche = htmlspecialchars($_POST['id_fleche']);
$id_scenario_strategique = htmlspecialchars($_POST['id_scenario_strategique']);

// Verification de la source de risque
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_source_de_risque)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Source de risque invalide";
}

// Verification de l'id fleche
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_fleche)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "ID Flèche invalide";
}

// Verification de la scenario strategique
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Scenario strategique invalide";
}
 
$modification = $bdd->prepare("UPDATE TA_EI_ER SET id_source_de_risque=? WHERE id_fleche=? AND id_scenario_strategique=? AND id_projet=? AND id_atelier=?");

if (isset($id_source_de_risque)&&isset($id_fleche)&&isset($id_scenario_strategique)) {
    $modification->bindParam(1, $id_source_de_risque);
    $modification->bindParam(2, $id_fleche);
    $modification->bindParam(3, $id_scenario_strategique);
    $modification->bindParam(4, $get_id_projet);
    $modification->bindParam(5, $id_atelier);
    $modification->execute();
}
?>