<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_scenario_strategique = $_POST['id_scenario_strategique'];

// Verification de l'id scénario
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant scénario invalide";
}

//suppression des EI dans la base de données 
$suppression = $bdd->prepare("DELETE FROM UA_EI WHERE id_scenario_strategique=? AND id_projet=? AND id_atelier=?");
if (isset($id_scenario_strategique)&&isset($get_id_projet)&&isset($id_atelier)) {
    $suppression->bindParam(1, $id_scenario_strategique);
    $suppression->bindParam(2, $get_id_projet);
    $suppression->bindParam(3, $id_atelier);
    $suppression->execute();
}
?>