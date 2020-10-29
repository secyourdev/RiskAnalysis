<?php
session_start();
$getid_utilisateur = $_SESSION['id_utilisateur'];

include("../bdd/connexion.php");

$id_projet = $_POST['id_projet'];

$search_projet = $bdd->prepare("SELECT id_projet_gen FROM F_projet WHERE id_projet=?");
$search_projet->bindParam(1,$id_projet);
$search_projet->execute();



$ecriture = $search_projet->fetch();

$array = array();

$search_projet = $bdd->prepare("SELECT num_version, description_version FROM ZC_version  WHERE id_projet_gen=?");
$search_projet->bindParam(1,$ecriture[0]);
$search_projet->execute();

while($ecriture = $search_projet->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>


