<?php
session_start();
$id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$recupere_seuil = $bdd->prepare("SELECT * FROM seuil WHERE id_projet = $id_projet");
$recupere_seuil->execute();

$array = array();

while($seuil = $recupere_seuil->fetch()){
    array_push($array, $seuil);
}

echo json_encode($array)
?>