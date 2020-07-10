<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v17");
$getid_projet = $_SESSION['id_projet'];

$query = "SELECT DISTINCT id_utilisateur,nom,prenom,poste FROM `RACI` NATURAL JOIN utilisateur WHERE id_projet =$getid_projet ORDER BY id_utilisateur ASC";
$acteur_choisi = mysqli_query($connect, $query);

$query2 = "SELECT DISTINCT id_utilisateur FROM `RACI` NATURAL JOIN utilisateur WHERE id_projet =$getid_projet ORDER BY id_utilisateur ASC";
$RACI_id_user = mysqli_query($connect, $query2);

$query3 = "SELECT DISTINCT nom,prenom FROM `RACI` NATURAL JOIN utilisateur WHERE id_projet =$getid_projet ORDER BY id_utilisateur ASC";
$RACI_user = mysqli_query($connect, $query3);

$query_grp_user = "SELECT nom_grp_utilisateur FROM grp_utilisateur";
$result_grp_user = mysqli_query($connect, $query_grp_user);


$recupere_id_grp_utilisateur = "SELECT id_grp_utilisateur FROM projet WHERE id_projet =$getid_projet";
$result_id_grp_utilisateur = mysqli_query($connect, $recupere_id_grp_utilisateur);
$result_fetch = mysqli_fetch_array($result_id_grp_utilisateur);
$id_grp_utilisateur = $result_fetch["id_grp_utilisateur"];

$query_RACI_user = "SELECT id_utilisateur,nom,prenom FROM impliquer NATURAL JOIN utilisateur WHERE id_grp_utilisateur=$id_grp_utilisateur";
$result_RACI_user  = mysqli_query($connect, $query_RACI_user);
?>