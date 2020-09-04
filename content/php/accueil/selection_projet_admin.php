<?php
session_start();
$getid_utilisateur = $_SESSION['id_utilisateur'];

include("../bdd/connexion.php");

$search_projet = $bdd->prepare("SELECT DISTINCT id_projet,nom_projet,description_projet,cadre_temporel,cadre_temporel_etape_2,cadre_temporel_etape_3,cadre_temporel_etape_4,cadre_temporel_etape_5, confidentialite, duree_strategique, duree_operationnel FROM F_projet");
$search_projet->execute();

$array = array();

while($ecriture = $search_projet->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>


