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

$search_path_EI_EI_for_schema = $bdd->prepare("SELECT TA_EI.id_EI, TA_EI.id_chemin FROM TA_EI WHERE TA_EI.id_projet=? AND TA_EI.id_scenario_strategique=?");
$search_path_EI_EI_for_schema->bindParam(1, $get_id_projet);
$search_path_EI_EI_for_schema->bindParam(2, $id_scenario_strategique);
$search_path_EI_EI_for_schema->execute();
    
$array_EI_EI = array();

while($ecriture_EI_EI = $search_path_EI_EI_for_schema->fetch()){
    array_push($array_EI_EI,$ecriture_EI_EI);
}

echo json_encode($array_EI_EI);

?>
