<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$id_scenario_strategique = $_POST['id_scenario_strategique'];

$search_path_for_schema = $bdd->prepare("SELECT TA_EI_ER.id_fleche, TA_EI_ER.valeur_chemin FROM TA_EI_ER WHERE TA_EI_ER.id_projet=? AND TA_EI_ER.id_scenario_strategique=?");
$search_path_for_schema->bindParam(1, $get_id_projet);
$search_path_for_schema->bindParam(2, $id_scenario_strategique);
$search_path_for_schema->execute();

$array = array();

while($ecriture = $search_path_for_schema->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array);
?>