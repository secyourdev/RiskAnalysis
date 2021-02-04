<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

//affichage tableau partie prenante
$query_partie_prenante = "SELECT * FROM R_partie_prenante WHERE id_projet = $getid_projet";
$result_partie_prenante = mysqli_query($connect, $query_partie_prenante);
$result_partie_prenante2 = mysqli_query($connect, $query_partie_prenante);

$query_mesure1 = "SELECT
Y_mesure.id_mesure,
R_partie_prenante.nom_partie_prenante,
Y_mesure.nom_mesure,
Y_mesure.description_mesure
FROM R_partie_prenante
INNER JOIN ZB_comporter_2
ON R_partie_prenante.id_partie_prenante = ZB_comporter_2.id_partie_prenante
INNER JOIN Y_mesure
ON Y_mesure.id_mesure = ZB_comporter_2.id_mesure
WHERE Y_mesure.id_projet = $getid_projet";

$query_mesure2 = "SELECT DISTINCT 
R_partie_prenante.id_partie_prenante,
nom_partie_prenante, 
dependance_partie_prenante,
penetration_partie_prenante,
maturite_partie_prenante,
confiance_partie_prenante, 
niveau_de_menace_partie_prenante,
dependance_residuelle,
penetration_residuelle,
maturite_residuelle,
confiance_residuelle,
niveau_de_menace_residuelle
FROM R_partie_prenante
INNER JOIN ZB_comporter_2
ON R_partie_prenante.id_partie_prenante = ZB_comporter_2.id_partie_prenante
INNER JOIN Y_mesure
ON Y_mesure.id_mesure = ZB_comporter_2.id_mesure
WHERE Y_mesure.id_projet = $getid_projet";


$result_mesure1 = mysqli_query($connect, $query_mesure1);
$result_mesure2 = mysqli_query($connect, $query_mesure2);

// $query_referentiel = "SELECT * FROM N_socle_de_securite WHERE id_projet = $getid_projet";
// $result_referentiel = mysqli_query($connect, $query_referentiel);