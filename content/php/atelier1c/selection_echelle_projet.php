<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$search_user = $bdd->prepare("SELECT id_echelle FROM F_projet NATURAL JOIN DA_echelle WHERE id_projet = $getid_projet");
$search_user->execute();

$array = array();

while($ecriture = $search_user->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>