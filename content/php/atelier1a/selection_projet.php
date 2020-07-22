<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$search_projet = $bdd->prepare("SELECT * FROM F_projet WHERE id_projet=?");
$search_projet->bindParam(1,$getid_projet);
$search_projet->execute();

$array = array();

while($ecriture = $search_projet->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)
?>