<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v6");
$query = "SELECT id_utilisateur,nom,prenom,poste FROM utilisateur ORDER BY id_utilisateur ASC";
$result = mysqli_query($connect, $query);
?>