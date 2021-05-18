<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

$querylegende = "SELECT DISTINCT id_risque, nom_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE T_chemin_d_attaque_strategique.id_projet = $getid_projet";

$resultlegende = mysqli_query($connect, $querylegende);
?>