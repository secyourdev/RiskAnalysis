<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$id_scenario_operationnel = $_POST['id_scenario_operationnel'];

$search_schema = $bdd->prepare("SELECT images FROM U_scenario_operationnel WHERE id_projet = ? AND id_atelier = '4.a' AND id_scenario_operationnel = ?");
$search_schema->bindParam(1, $get_id_projet);
$search_schema->bindParam(2, $id_scenario_operationnel);
$search_schema->execute();


$array = array();

while($ecriture = $search_schema->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>