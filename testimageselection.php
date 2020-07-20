<?php
$getid_projet = intval($_GET['id_projet']);
$id_atelier = '3.b';

//Connexion à la base de donnee
include("content/php/bdd/connexion_sqli.php");

$query = "SELECT * FROM scenario_operationnel WHERE id_projet = $getid_projet";
print $query;
$result = mysqli_query($bdd, $query);
// var_dump($result);
$query_scenario_op= "SELECT id_scenario_operationnel, nom_scenario_operationnel FROM scenario_operationnel WHERE id_projet = $getid_projet AND id_atelier = '3.b'";
print $query_scenario_op;
$result_scenario_op = mysqli_query($bdd, $query_scenario_op);
print_r($result_scenario_op);