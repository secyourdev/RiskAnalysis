<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v5");
$query = "SELECT * FROM socle_de_securite ORDER BY id_socle_securite";

$result = mysqli_query($connect, $query);
?>