<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

include("../bdd/connexion.php");

$id_scenario = $_POST['id_scenario'];

$query = $bdd->prepare("SELECT image FROM scenario_strategique WHERE id_projet = ? AND id_scenario_strategique = ?");
$query->bindParam(1, $getid_projet);
$query->bindParam(2, $id_scenario);
$query->execute();
$nomimage = $query->fetch();

echo "$nomimage[0]";
