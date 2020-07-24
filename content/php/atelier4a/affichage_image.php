<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
$id_atelier = '4.a';

include("../bdd/connexion.php");

$id_scenario = $_POST['id_scenario'];

$query = $bdd->prepare("SELECT image FROM U_scenario_operationnel WHERE id_projet = ? AND id_scenario_operationnel = ?");
$query->bindParam(1, $getid_projet);
$query->bindParam(2, $id_scenario);
$query->execute();
$nomimage = $query->fetch();

echo "$nomimage[0]";
