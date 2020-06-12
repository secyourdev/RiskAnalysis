<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v5");
$query = "SELECT * FROM evenement_redoutes INNER JOIN valeur_metier on evenement_redoutes.id_valeur_metier = valeur_metier.id_valeur_metier";
$result = mysqli_query($connect, $query);
?>