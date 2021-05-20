<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$search_evenement_redoute_for_schema = $bdd->prepare("SELECT id_evenement_redoute, nom_evenement_redoute FROM M_evenement_redoute WHERE M_evenement_redoute.id_projet=?");
$search_evenement_redoute_for_schema->bindParam(1, $get_id_projet);
$search_evenement_redoute_for_schema->execute();

$array = array();

while($ecriture = $search_evenement_redoute_for_schema->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array);
?>