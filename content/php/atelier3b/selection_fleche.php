<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$valeur_fleche = $_POST['valeur_fleche'];
$id_scenario_strategique = $_POST['id_scenario_strategique'];

// Verification de la valeur flèche
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-\_.:,'\"–]{0,100}$/", $valeur_fleche)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Valeur flèche invalide";
}

// Verification de l'id scénario
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant scénario invalide";
}

$search_flow_for_schema = $bdd->prepare("SELECT valeur_chemin FROM TB_fleche WHERE valeur_fleche= ? AND id_scenario_strategique=? AND id_projet=? AND id_atelier=?");

if (isset($valeur_fleche)&&isset($id_scenario_strategique)&&isset($get_id_projet)&&isset($id_atelier)&&$results["error"]!=true) {
    $search_flow_for_schema->bindParam(1, $valeur_fleche);
    $search_flow_for_schema->bindParam(2, $id_scenario_strategique);
    $search_flow_for_schema->bindParam(3, $get_id_projet);
    $search_flow_for_schema->bindParam(4, $id_atelier);
    $search_flow_for_schema->execute();

    $array = array();

    while($ecriture = $search_flow_for_schema->fetch()){
        array_push($array,$ecriture);
    }

    echo json_encode($array);
}

else{
    echo 'Erreur !';
}
?>