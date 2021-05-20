<?php
// $getid_projet = intval($_GET['id_projet']);


$getid_projet = $_SESSION['id_projet'];
$id_atelier = '3.a';
include("content/php/bdd/connexion_sqli.php");

$query = "SELECT * FROM R_partie_prenante WHERE id_projet = $getid_projet AND id_atelier = '$id_atelier'";

$query_categorie_partie_prenante = "SELECT DISTINCT categorie_partie_prenante FROM R_partie_prenante WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);
$result_categorie_partie_prenante = mysqli_query($connect, $query_categorie_partie_prenante);


$querytest = "SELECT niveau_de_menace_partie_prenante FROM R_partie_prenante ORDER BY id_partie_prenante ASC";
$resulttest = mysqli_query($connect, $querytest);


$rq_partie = "SELECT categorie_partie_prenante AS 'Catégorie', nom_partie_prenante AS 'Partie prenante', type AS 'Type', dependance_partie_prenante AS 'Dépendance', ponderation_dependance AS 'Facteur de pondération dépendance', penetration_partie_prenante AS 'Pénétration', ponderation_penetration AS 'Facteur de pondération pénétration', maturite_partie_prenante AS 'Maturité', ponderation_maturite AS 'Facteur de pondération maturité', confiance_partie_prenante AS 'Confiance', ponderation_confiance AS 'Facteur de pondération confiance', niveau_de_menace_partie_prenante AS 'Niveau de Menace', criticite AS 'Criticité' FROM R_partie_prenante WHERE id_projet = $getid_projet ";
$rq_partie_tab = mysqli_query($connect, $rq_partie);


?>
