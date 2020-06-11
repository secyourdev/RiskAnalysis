<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v5");
$query = "SELECT * FROM personne ORDER BY id_personne ASC";
$result = mysqli_query($connect, $query);
?>