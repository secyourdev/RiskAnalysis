<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

$query1 = "SELECT 
U_scenario_operationnel.id_scenario_operationnel,
T_chemin_d_attaque_strategique.id_risque,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
U_scenario_operationnel.description_scenario_operationnel,
U_scenario_operationnel.vraisemblance
FROM U_scenario_operationnel,T_chemin_d_attaque_strategique
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND U_scenario_operationnel.id_projet = $getid_projet
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet";

$queryprojet = "SELECT echelle_vraisemblance FROM F_projet NATURAL JOIN DA_echelle WHERE id_projet = $getid_projet";

$result1 = mysqli_query($connect, $query1);
$resultprojet = mysqli_query($connect, $queryprojet);
?>

