<?php
session_start(); 
$getid_utilisateur = $_SESSION['id_utilisateur'];

include("../bdd/connexion.php");

$search_user = $bdd->prepare("SELECT nom,prenom,poste,email,type_compte FROM utilisateur WHERE id_utilisateur=?");
$search_user->bindParam(1, $getid_utilisateur);
$search_user->execute();

$array = array();

while($ecriture = $search_user->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)
?>