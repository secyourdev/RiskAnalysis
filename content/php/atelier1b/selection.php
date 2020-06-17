<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v6");
$query1 = "SELECT * FROM mission NATURAL JOIN personne ORDER BY id_mission ASC";
$query2 = "SELECT * FROM valeur_metier NATURAL JOIN personne INNER JOIN mission ON valeur_metier.id_mission = mission.id_mission ORDER BY id_valeur_metier DESC";
$query3 = "SELECT * FROM bien_support NATURAL JOIN personne INNER JOIN valeur_metier ON bien_support.id_valeur_metier = valeur_metier.id_valeur_metier ORDER BY id_bien_support DESC";
$querymission = "SELECT nom_mission FROM mission";
$querynomresponsablemission = "SELECT nom FROM personne";
$queryprenomresponsablemission = "SELECT prenom FROM personne";
$queryposteresponsablemission = "SELECT poste FROM personne";
$queryvm = "SELECT nom_valeur_metier FROM valeur_metier";




$result1 = mysqli_query($connect, $query1);
$result2 = mysqli_query($connect, $query2);
$result3 = mysqli_query($connect, $query3);
$resultnomresponsablemission = mysqli_query($connect, $querynomresponsablemission);
$resultprenomresponsablemission = mysqli_query($connect, $queryprenomresponsablemission);
$resultposteresponsablemission = mysqli_query($connect, $queryposteresponsablemission);
$resultvm = mysqli_query($connect, $queryvm);
$resultmission = mysqli_query($connect, $querymission);
?>