<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");
$query = "SELECT * FROM grp_utilisateur ORDER BY id_grp_utilisateur ASC";
$result = mysqli_query($connect, $query);

$query_grp_user = "SELECT nom_grp_utilisateur FROM grp_utilisateur";

$result_grp_user = mysqli_query($connect, $query_grp_user);
$result_grp_user_creation = mysqli_query($connect, $query_grp_user);
?>