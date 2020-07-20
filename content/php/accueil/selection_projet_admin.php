<?php
session_start();
$getid_utilisateur = $_SESSION['id_utilisateur'];

include("../bdd/connexion.php");

$search_projet = $bdd->prepare("SELECT DISTINCT id_projet,nom_projet,description_projet,cadre_temporel FROM projet");
$search_projet->execute();

$array = array();

while($ecriture = $search_projet->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>


