<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_partie_prenante = htmlspecialchars($_POST['id_partie_prenante']);
$id_fleche = htmlspecialchars($_POST['id_fleche']);
$id_scenario_strategique = htmlspecialchars($_POST['id_scenario_strategique']);

// Verification de la partie prenante
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_partie_prenante)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Partie prenante invalide";
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
 
$modification = $bdd->prepare("UPDATE TA_EI_ER SET id_partie_prenante=? WHERE id_fleche=? AND id_scenario_strategique=? AND id_projet=? AND id_atelier=?");

if (isset($id_partie_prenante)&&isset($id_fleche)&&isset($id_scenario_strategique)) {
    $modification->bindParam(1, $id_partie_prenante);
    $modification->bindParam(2, $id_fleche);
    $modification->bindParam(3, $id_scenario_strategique);
    $modification->bindParam(4, $get_id_projet);
    $modification->bindParam(5, $id_atelier);
    $modification->execute();
}
?>