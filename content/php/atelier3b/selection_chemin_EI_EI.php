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

$chemin_valeur = ['C1','C2','C3','C4','C5','C6','C7','C8','C9'];

for($i=0;$i<count($chemin_valeur);++$i){
    $search_path_EI_EI_for_schema = $bdd->prepare("SELECT TA_EI.id_EI FROM TA_EI WHERE TA_EI.id_chemin=? AND TA_EI.id_projet=? AND TA_EI.id_scenario_strategique=?");
    $search_path_EI_EI_for_schema->bindParam(1, $chemin_valeur[$i]);
    $search_path_EI_EI_for_schema->bindParam(2, $get_id_projet);
    $search_path_EI_EI_for_schema->bindParam(3, $id_scenario_strategique);
    $search_path_EI_EI_for_schema->execute();
    

$array_EI_EI = array();

while($ecriture_EI_EI = $search_path_EI_EI_for_schema->fetch()){
    array_push($array_EI_EI,$ecriture_EI_EI);
}

echo json_encode($array_EI_EI);

}

?>
