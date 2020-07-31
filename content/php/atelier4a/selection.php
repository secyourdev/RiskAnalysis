<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");
$query1 = "SELECT S_scenario_strategique.id_scenario_strategique, nom_scenario_strategique, description_source_de_risque, objectif_vise, nom_evenement_redoute, id_risque, nom_chemin_d_attaque_strategique, niveau_de_gravite FROM S_scenario_strategique 
INNER JOIN P_SROV ON S_scenario_strategique.id_source_de_risque = P_SROV.id_source_de_risque 
INNER JOIN M_evenement_redoute ON S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
INNER JOIN T_chemin_d_attaque_strategique On S_scenario_strategique.id_scenario_strategique = T_chemin_d_attaque_strategique.id_scenario_strategique
INNER JOIN R_partie_prenante ON T_chemin_d_attaque_strategique.id_partie_prenante = R_partie_prenante.id_partie_prenante
WHERE S_scenario_strategique.id_projet = $getid_projet 
";

$query2 = "SELECT 
U_scenario_operationnel.id_scenario_operationnel,
T_chemin_d_attaque_strategique.id_risque,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
U_scenario_operationnel.description_scenario_operationnel
FROM U_scenario_operationnel,T_chemin_d_attaque_strategique
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND U_scenario_operationnel.id_projet = $getid_projet
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet";
$query3 = "SELECT * FROM U_scenario_operationnel WHERE id_projet = $getid_projet";
$query4 = "SELECT * FROM W_mode_operatoire INNER JOIN U_scenario_operationnel
ON W_mode_operatoire.id_scenario_operationnel = U_scenario_operationnel.id_scenario_operationnel WHERE id_projet = $getid_projet";
$queryprojet = "SELECT echelle_vraisemblance FROM F_projet NATURAL JOIN DA_echelle WHERE id_projet = $getid_projet";

$result1 = mysqli_query($connect, $query1);
$result2 = mysqli_query($connect, $query2);
$result3 = mysqli_query($connect, $query3);
$result4 = mysqli_query($connect, $query4);
$resultprojet = mysqli_query($connect, $queryprojet);


// browse image
$query = "SELECT * FROM U_scenario_operationnel WHERE id_projet = $getid_projet";
$result = mysqli_query($connect, $query);
$query_scenario_op = "SELECT id_scenario_operationnel, description_scenario_operationnel FROM U_scenario_operationnel WHERE id_projet = $getid_projet AND id_atelier = '4.a'";
$result_scenario_op = mysqli_query($connect, $query_scenario_op);