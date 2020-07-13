<?php
$getid_projet = intval($_GET['id_projet']);
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v19");

$query1 = "SELECT * FROM mission WHERE mission.id_projet = $getid_projet ORDER BY mission.id_mission ASC";
$result1 = mysqli_query($connect, $query1);

$query2 = "SELECT * FROM valeur_metier WHERE valeur_metier.id_projet = $getid_projet ORDER BY valeur_metier.id_valeur_metier ASC";
$result2 = mysqli_query($connect, $query2);

$query3 = "SELECT * FROM bien_support WHERE bien_support.id_projet = $getid_projet ORDER BY bien_support.id_bien_support ASC";
$result3 = mysqli_query($connect, $query3);

$queryvm = "SELECT nom_valeur_metier FROM valeur_metier WHERE id_projet = $getid_projet";
$resultvm = mysqli_query($connect, $queryvm);

$querybien = "SELECT nom_bien_support FROM bien_support WHERE id_projet = $getid_projet";
$resultbien = mysqli_query($connect, $querybien);