<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v5");
$query = "SELECT * FROM evenement_redoutes ORDER BY id_evenement_redoutes DESC";
$result = mysqli_query($connect, $query);
?>