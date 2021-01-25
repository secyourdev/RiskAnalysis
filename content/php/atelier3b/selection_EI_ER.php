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

$selection = $bdd->prepare("SELECT numero_chemin,valeur_chemin FROM TA_EI_ER WHERE id_fleche=? AND id_scenario_strategique=? AND id_projet=? AND id_atelier=?");

if (isset($id_fleche)&&isset($id_scenario_strategique)){
    $selection->bindParam(1, $id_fleche);
    $selection->bindParam(2, $id_scenario_strategique);
    $selection->bindParam(3, $get_id_projet);
    $selection->bindParam(4, $id_atelier);
    $selection->execute();

    $array = array();

    while($ecriture = $selection->fetch()){
        array_push($array,$ecriture);
    }

    echo json_encode($array);
}
?>