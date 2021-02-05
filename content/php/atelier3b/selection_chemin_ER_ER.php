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


$search_path_ER_ER_for_schema = $bdd->prepare("SELECT TA_ER.id_ER, TA_ER.id_chemin FROM TA_ER WHERE TA_ER.id_projet=? AND TA_ER.id_scenario_strategique=?");
$search_path_ER_ER_for_schema->bindParam(1, $get_id_projet);
$search_path_ER_ER_for_schema->bindParam(2, $id_scenario_strategique);
$search_path_ER_ER_for_schema->execute();

$array_ER_ER = array();

while($ecriture_ER_ER = $search_path_ER_ER_for_schema->fetch()){
    array_push($array_ER_ER,$ecriture_ER_ER);
}

echo json_encode($array_ER_ER);

?>