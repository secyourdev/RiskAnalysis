<?php

include("../bdd/connexion.php");

$search_user = $bdd->prepare("SELECT * FROM utilisateur");
$search_user->execute();

$array = array();

while($ecriture = $search_user->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>