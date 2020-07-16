<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");
$query = "SELECT * FROM traitement_de_securite";


$result = mysqli_query($connect, $query);

?>