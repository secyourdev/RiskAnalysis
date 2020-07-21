<?php
include("content/php/bdd/connexion_sqli.php");

$query = "SELECT * FROM B_grp_utilisateur ORDER BY id_grp_utilisateur ASC";
$result = mysqli_query($connect, $query);

$query_grp_user = "SELECT id_grp_utilisateur, nom_grp_utilisateur FROM B_grp_utilisateur";

$result_grp_user = mysqli_query($connect, $query_grp_user);
$result_grp_user_creation = mysqli_query($connect, $query_grp_user);
$result_grp_user_modification = mysqli_query($connect, $query_grp_user);
?>