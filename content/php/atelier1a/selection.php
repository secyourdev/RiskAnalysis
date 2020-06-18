<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v6");
$query = "SELECT id_utilisateur,nom,prenom,poste FROM utilisateur ORDER BY id_utilisateur ASC";
$result = mysqli_query($connect, $query);

$query2 = "SELECT id_utilisateur FROM utilisateur ORDER BY id_utilisateur ASC";
$result2 = mysqli_query($connect, $query2);

$query3 = "SELECT nom,prenom FROM utilisateur ORDER BY id_utilisateur ASC";
$result3 = mysqli_query($connect, $query3);

$query4 = "SELECT nom_projet FROM projet WHERE id_projet=1";
$projet_nom = mysqli_query($connect, $query4);

?>