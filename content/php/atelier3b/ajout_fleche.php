<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$valeur_fleche = $_POST['valeur_fleche'];
$valeur_chemin = $_POST['valeur_chemin'];
$id_scenario_strategique = $_POST['id_scenario_strategique'];

// Verification de la valeur flèche
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-\_.:,'\"–]{0,100}$/", $valeur_fleche)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Valeur flèche invalide";
}

// Verification du valeur chemin
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $valeur_chemin)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Valeur chemin invalide";
}

// Verification de l'id scénario
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant scénario invalide";
}

$insere = $bdd->prepare("INSERT INTO TB_fleche (valeur_fleche,valeur_chemin,id_scenario_strategique,id_projet,id_atelier) VALUES (?,?,?,?,?)");

if (isset($valeur_fleche)&&isset($valeur_chemin)&&isset($id_scenario_strategique)&&isset($get_id_projet)&&isset($id_atelier)&&$results["error"]!=true) {
    $insere->bindParam(1, $valeur_fleche);
    $insere->bindParam(2, $valeur_chemin);
    $insere->bindParam(3, $id_scenario_strategique);
    $insere->bindParam(4, $get_id_projet);
    $insere->bindParam(5, $id_atelier);
    $insere->execute();
}

else{
    echo 'Erreur !';
}
?>