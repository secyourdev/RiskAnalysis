<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$id_scenario_strategique = $_POST['id_scenario_strategique'];

$search_SROV_for_schema = $bdd->prepare("SELECT P_SROV.id_source_de_risque, P_SROV.profil_de_l_attaquant_source_de_risque, P_SROV.objectif_vise FROM S_scenario_strategique INNER JOIN P_SROV ON S_scenario_strategique.id_source_de_risque = P_SROV.id_source_de_risque WHERE S_scenario_strategique.id_projet=? AND S_scenario_strategique.id_scenario_strategique=?");
$search_SROV_for_schema->bindParam(1, $get_id_projet);
$search_SROV_for_schema->bindParam(2, $id_scenario_strategique);
$search_SROV_for_schema->execute();

$array = array();

while($ecriture = $search_SROV_for_schema->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array);
?>