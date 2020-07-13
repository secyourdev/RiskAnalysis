<?php
$getid_projet = intval($_GET['id_projet']);
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v19");

$query1 = "SELECT * FROM mission WHERE mission.id_projet = $getid_projet ORDER BY mission.id_mission ASC";
$result1 = mysqli_query($connect, $query1);

$query2 = "SELECT * FROM bien_support WHERE bien_support.id_projet = $getid_projet ORDER BY bien_support.id_bien_support ASC";
$result2 = mysqli_query($connect, $query2);

$query3 = "SELECT * FROM valeur_metier WHERE valeur_metier.id_projet = $getid_projet ORDER BY valeur_metier.id_valeur_metier ASC";
$result3 = mysqli_query($connect, $query3);
