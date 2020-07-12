<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v9");


$query1 = "SELECT * FROM scenario_operationnel NATURAL JOIN chemin_d_attaque_strategique";


$result1 = mysqli_query($connect, $query1);

?>

