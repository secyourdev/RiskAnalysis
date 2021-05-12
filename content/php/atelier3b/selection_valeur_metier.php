<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$search_valeur_metier_for_schema = $bdd->prepare("SELECT J_valeur_metier.id_valeur_metier, J_valeur_metier.nom_valeur_metier FROM J_valeur_metier WHERE J_valeur_metier.id_projet = ?");
$search_valeur_metier_for_schema->bindParam(1, $get_id_projet);
$search_valeur_metier_for_schema->execute();

$array = array();

while($ecriture = $search_valeur_metier_for_schema->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array);
?>