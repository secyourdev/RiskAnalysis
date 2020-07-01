<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v12");
$query_socle = "SELECT * FROM socle_de_securite ORDER BY id_socle_securite";
$query_ecart = "SELECT * FROM ecarts, personne, dates, referentiel WHERE personne.id_personne = ecarts.id_personne AND dates.id_date = ecarts.id_date AND referentiel.id_referenciel = ecarts.id_referenciel";
$query_id_socle = 'SELECT id_socle_securite FROM socle_de_securite';
$queryprenomresponsable = "SELECT nom FROM personne";


$resultprenomresponsable = mysqli_query($connect, $queryprenomresponsable);
$result_id_socle = mysqli_query($connect, $query_id_socle);
$result_socle = mysqli_query($connect, $query_socle);
$result_ecart = mysqli_query($connect, $query_ecart);
?>