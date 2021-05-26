<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

//$search_echelle = $bdd->prepare("SELECT id_echelle_vraisemblance FROM F_projet NATURAL JOIN DC_echelle_vraisemblance WHERE F_projet.id_projet = $getid_projet");
$search_echelle = $bdd->prepare("SELECT id_echelle_vraisemblance FROM F_projet WHERE F_projet.id_projet = $getid_projet");

$search_echelle->execute();

$array = array();

while($ecriture = $search_echelle->fetch()){
array_push($array,$ecriture);
}

echo json_encode($array)

?>