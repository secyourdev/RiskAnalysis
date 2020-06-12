<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v5");
$query1 = "SELECT * FROM mission NATURAL JOIN utilisateur NATURAL JOIN personne ORDER BY id_mission ASC";
$query2 = "SELECT * FROM valeur_metier NATURAL JOIN personne ORDER BY id_valeur_metier DESC";
$query3 = "SELECT * FROM bien_support NATURAL JOIN personne ORDER BY id_bien_support DESC";
$querynomresponsablemission = "SELECT nom FROM utilisateur NATURAL JOIN personne";
$queryprenomresponsablemission = "SELECT prenom FROM utilisateur NATURAL JOIN personne";
$queryposteresponsablemission = "SELECT poste FROM utilisateur NATURAL JOIN personne";
$queryvm = "SELECT nom_valeur_metier FROM valeur_metier";



$result1 = mysqli_query($connect, $query1);
$result2 = mysqli_query($connect, $query2);
$result3 = mysqli_query($connect, $query3);
$resultnomresponsablemission = mysqli_query($connect, $querynomresponsablemission);
$resultprenomresponsablemission = mysqli_query($connect, $queryprenomresponsablemission);
$resultposteresponsablemission = mysqli_query($connect, $queryposteresponsablemission);
$resultvm = mysqli_query($connect, $queryvm);
?>