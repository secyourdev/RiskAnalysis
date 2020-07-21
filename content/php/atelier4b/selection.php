<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

$query1 = "SELECT * FROM V_scenario_operationnel NATURAL JOIN T_chemin_d_attaque_strategique WHERE id_projet = $getid_projet";
$queryprojet = "SELECT echelle_vraisemblance FROM F_projet NATURAL JOIN D_echelle WHERE id_projet = $getid_projet";

$result1 = mysqli_query($connect, $query1);
$resultprojet = mysqli_query($connect, $queryprojet);
?>

