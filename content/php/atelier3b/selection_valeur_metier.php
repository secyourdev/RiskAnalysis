<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$id_scenario_strategique = $_POST['id_scenario_strategique'];

$search_valeur_metier_for_schema = $bdd->prepare("SELECT J_valeur_metier.id_valeur_metier, J_valeur_metier.nom_valeur_metier FROM S_scenario_strategique INNER JOIN M_evenement_redoute ON S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute INNER JOIN J_valeur_metier ON M_evenement_redoute.id_valeur_metier = J_valeur_metier.id_valeur_metier WHERE S_scenario_strategique.id_projet = ? AND S_scenario_strategique.id_scenario_strategique = ?");
$search_valeur_metier_for_schema->bindParam(1, $get_id_projet);
$search_valeur_metier_for_schema->bindParam(2, $id_scenario_strategique);
$search_valeur_metier_for_schema->execute();

$array = array();

while($ecriture = $search_valeur_metier_for_schema->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array);
?>