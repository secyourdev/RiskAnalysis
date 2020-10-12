<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$id_scenario_strategique = $_POST['id_scenario_strategique'];

$search_schema = $bdd->prepare("SELECT image FROM S_scenario_strategique WHERE id_projet = ? AND id_atelier = '3.b' AND id_scenario_strategique = ?");
$search_schema->bindParam(1, $get_id_projet);
$search_schema->bindParam(2, $id_scenario_strategique);
$search_schema->execute();


$array = array();

while($ecriture = $search_schema->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>