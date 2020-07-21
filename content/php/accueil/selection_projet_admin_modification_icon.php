<?php
session_start();
$getid_utilisateur = $_SESSION['id_utilisateur'];

include("../bdd/connexion.php");

$id_projet = $_POST['id_projet'];

$search_projet = $bdd->prepare("SELECT id_projet,nom_projet,description_projet,id_grp_utilisateur FROM F_projet WHERE id_projet=?");
$search_projet->bindParam(1,$id_projet);
$search_projet->execute();

$array = array();

while($ecriture = $search_projet->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>


