<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$search_echelle = $bdd->prepare("SELECT id_echelle,echelle_vraisemblance FROM F_projet NATURAL JOIN DA_echelle WHERE id_projet = $getid_projet");
$search_echelle->execute();

$array = array();

while($ecriture = $search_echelle->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>