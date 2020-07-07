<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v14");

$query_socle = "SELECT * FROM socle_de_securite ORDER BY id_socle_securite";

$query_ecart =
"SELECT
ecarts.id_ecarts,
regle.id_regle,
regle.titre,
regle.etat_de_la_regle,
ecarts.justification_ecart,
personne.nom,
dates.date
FROM
regle, ecarts, personne, dates
WHERE
ecarts.id_regle = regle.id_regle
AND ecarts.id_date = dates.id_date
AND ecarts.id_personne = personne.id_personne";


$query_nom_referentiel = "SELECT nom_referentiel FROM socle_de_securite WHERE id_atelier = '1.d' AND id_projet = '1' ORDER BY id_socle_securite";


$result_socle = mysqli_query($connect, $query_socle);
$result_ecart = mysqli_query($connect, $query_ecart);
$result_nom_referentiel = mysqli_query($connect, $query_nom_referentiel);
$result_nom_referentiel2 = mysqli_query($connect, $query_nom_referentiel);
