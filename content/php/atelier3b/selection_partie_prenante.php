<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$search_partie_prenante_for_schema = $bdd->prepare("SELECT nom_partie_prenante FROM R_partie_prenante WHERE R_partie_prenante.id_projet=?");
$search_partie_prenante_for_schema->bindParam(1, $get_id_projet);
$search_partie_prenante_for_schema->execute();

$array = array();

while($ecriture = $search_partie_prenante_for_schema->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array);
?>