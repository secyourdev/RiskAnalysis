<?php
// session_start();
$getid_projet = $_SESSION['id_projet'];

include("content/php/bdd/connexion_sqli.php");

$query_socle = "SELECT * FROM N_socle_de_securite WHERE id_atelier = '1.d' AND id_projet = $getid_projet ORDER BY id_socle_securite";


$query_nom_referentiel = "SELECT nom_referentiel FROM N_socle_de_securite WHERE id_atelier = '1.d' AND id_projet = $getid_projet ORDER BY id_socle_securite";

$result_socle = mysqli_query($connect, $query_socle);
$result_nom_referentiel = mysqli_query($connect, $query_nom_referentiel);
$result_nom_referentiel2 = mysqli_query($connect, $query_nom_referentiel);
