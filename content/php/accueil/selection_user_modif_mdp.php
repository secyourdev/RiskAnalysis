<?php

include("../bdd/connexion.php");

$id_utilisateur=$_POST['id_utilisateur'];

$search_user = $bdd->prepare("SELECT email FROM utilisateur WHERE id_utilisateur=?");
$search_user->bindParam(1,$id_utilisateur);
$search_user->execute();

$array = array();

while($ecriture = $search_user->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>