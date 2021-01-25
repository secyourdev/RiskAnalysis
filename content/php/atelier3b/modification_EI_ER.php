<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_fleche = htmlspecialchars($_POST['id_fleche']);
$id_scenario_strategique = htmlspecialchars($_POST['id_scenario_strategique']);
$numero_chemin = htmlspecialchars($_POST['numero_chemin']);
$valeur_chemin = htmlspecialchars($_POST['valeur_chemin']);


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

// Verification du numero_chemin
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $numero_chemin)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Numero Chemin invalide";
}
 
// Verification de la valeur_chemin
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $valeur_chemin)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Valeur Chemin invalide";
}
 
 
$modification = $bdd->prepare("UPDATE TA_EI_ER SET numero_chemin=?, valeur_chemin=? WHERE id_fleche=? AND id_scenario_strategique=? AND id_projet=? AND id_atelier=?");

if (isset($id_fleche)&&isset($id_scenario_strategique)&&isset($numero_chemin)&&isset($valeur_chemin)){
    $modification->bindParam(1, $numero_chemin);
    $modification->bindParam(2, $valeur_chemin);
    $modification->bindParam(3, $id_fleche);
    $modification->bindParam(4, $id_scenario_strategique);
    $modification->bindParam(5, $get_id_projet);
    $modification->bindParam(6, $id_atelier);
    $modification->execute();
}
?>