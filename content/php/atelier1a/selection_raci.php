<?php
session_start(); 
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$search_raci = $bdd->prepare("SELECT * FROM H_RACI where id_projet=?");
$search_raci->bindParam(1, $getid_projet);
$search_raci->execute();

$array = array();

while($ecriture = $search_raci->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)
?>