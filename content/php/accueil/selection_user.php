<?php
include("content/php/bdd/connexion_sqli.php");
$query_user = "SELECT id_utilisateur,nom,prenom FROM A_utilisateur ORDER BY id_utilisateur ASC";
$result_user = mysqli_query($connect, $query_user);
$result_chef_de_projet_creation = mysqli_query($connect, $query_user);
$result_chef_de_projet_modification = mysqli_query($connect, $query_user);

$query_full_user = "SELECT id_utilisateur,nom,prenom,poste,email,type_compte FROM A_utilisateur ORDER BY id_utilisateur ASC";
$result_full_user = mysqli_query($connect, $query_full_user);
?>