<?php

include("../bdd/connexion.php");

$search_grp_user = $bdd->prepare("SELECT * FROM B_grp_utilisateur");
$search_grp_user->execute();

$array = array();

while($ecriture = $search_grp_user->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>