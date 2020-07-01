<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v12");
$query_socle = "SELECT * FROM socle_de_securite ORDER BY id_socle_securite";
$query_ecart =
"SELECT
ecarts.id_ecarts,
referentiel.id_regle,
referentiel.titre,
referentiel.etat_de_la_regle,
ecarts.justification_ecart,
personne.nom,
dates.date
FROM
referentiel, ecarts, personne, dates
WHERE
ecarts.id_regle = referentiel.id_regle
AND ecarts.id_date = dates.id_date
AND ecarts.id_personne = personne.id_personne";
$query_titre_regle = 'SELECT referentiel.titre FROM referentiel';
// $queryprenomresponsable = "SELECT nom FROM personne";


$result_socle = mysqli_query($connect, $query_socle);
$result_ecart = mysqli_query($connect, $query_ecart);
$result_titre_regle = mysqli_query($connect, $query_titre_regle);
// $result_id_socle = mysqli_query($connect, $query_id_socle);
