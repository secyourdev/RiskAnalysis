<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v14");
$query = "SELECT id_utilisateur,nom,prenom,poste FROM `RACI` NATURAL JOIN utilisateur ORDER BY id_utilisateur ASC";
$result = mysqli_query($connect, $query);

$query2 = "SELECT id_utilisateur FROM `RACI` NATURAL JOIN utilisateur ORDER BY id_utilisateur ASC";
$result2 = mysqli_query($connect, $query2);

$query3 = "SELECT nom,prenom FROM `RACI` NATURAL JOIN utilisateur ORDER BY id_utilisateur ASC";
$result3 = mysqli_query($connect, $query3);

$query_grp_user = "SELECT nom_grp_utilisateur FROM grp_utilisateur";
$result_grp_user = mysqli_query($connect, $query_grp_user);
?>