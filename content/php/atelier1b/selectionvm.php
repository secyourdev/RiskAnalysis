<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$search_vm = $bdd->prepare("SELECT id_valeur_metier,nom_valeur_metier FROM valeur_metier WHERE id_projet=?");
$search_vm->bindParam(1,$getid_projet);
$search_vm->execute();

$array = array();

while($ecriture = $search_vm->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>