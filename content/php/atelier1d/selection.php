<?php
// session_start();
$getid_projet = $_SESSION['id_projet'];

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v20");

$query_socle = "SELECT * FROM socle_de_securite WHERE id_projet = $getid_projet ORDER BY id_socle_securite ";

// $query_regle =
// "SELECT * FROM regle ORDER BY id_regle ASC";


$query_nom_referentiel = "SELECT nom_referentiel FROM socle_de_securite WHERE id_atelier = '1.d' AND id_projet = $getid_projet ORDER BY id_socle_securite";


$result_socle = mysqli_query($connect, $query_socle);
// $result_regle = mysqli_query($connect, $query_regle);
$result_nom_referentiel = mysqli_query($connect, $query_nom_referentiel);
$result_nom_referentiel2 = mysqli_query($connect, $query_nom_referentiel);
