<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$verification_respo = $bdd->prepare("SELECT F_projet.responsable_risque_residuel FROM F_projet WHERE id_projet=?");
$verification_respo->bindParam(1,$getid_projet);
$verification_respo->execute();
$resultat = $verification_respo->fetch();

if($resultat[0]!=null){
    $search_projet = $bdd->prepare("SELECT F_projet.id_projet, F_projet.nom_projet, F_projet.objectif_projet, F_projet.cadre_temporel, F_projet.cadre_temporel_etape_2, F_projet.cadre_temporel_etape_3, F_projet.cadre_temporel_etape_4, F_projet.cadre_temporel_etape_5, F_projet.responsable_risque_residuel, A_utilisateur.nom, A_utilisateur.prenom FROM F_projet INNER JOIN A_utilisateur ON F_projet.responsable_risque_residuel = A_utilisateur.id_utilisateur WHERE id_projet=?");
}
else{
    $search_projet = $bdd->prepare("SELECT F_projet.id_projet, F_projet.nom_projet, F_projet.objectif_projet, F_projet.cadre_temporel, F_projet.cadre_temporel_etape_2, F_projet.cadre_temporel_etape_3, F_projet.cadre_temporel_etape_4, F_projet.cadre_temporel_etape_5,F_projet.responsable_risque_residuel FROM F_projet WHERE id_projet=?");
} 
    $search_projet->bindParam(1,$getid_projet);
    $search_projet->execute();
    
$array = array();

while($ecriture = $search_projet->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)
?>