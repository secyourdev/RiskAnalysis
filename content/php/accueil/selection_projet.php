<?php
session_start();
$getid_utilisateur = $_SESSION['id_utilisateur'];

include("../bdd/connexion.php");

$search_projet = $bdd->prepare("SELECT DISTINCT F_projet.id_projet, nom_projet,description_projet, cadre_temporel, cadre_temporel_etape_2, cadre_temporel_etape_3, cadre_temporel_etape_4, cadre_temporel_etape_5, confidentialite, duree_strategique, duree_operationnel, id_projet_gen FROM H_RACI INNER JOIN F_projet ON H_RACI.id_projet = F_projet.id_projet WHERE H_RACI.id_utilisateur=?");
$search_projet->bindParam(1, $getid_utilisateur);
$search_projet->execute();

$array = array();

while($ecriture = $search_projet->fetch()){
    array_push($array,$ecriture);
}

if($array==null){
    $search_projet = $bdd->prepare("SELECT DISTINCT F_projet.id_projet, nom_projet,description_projet,cadre_temporel, cadre_temporel_etape_2, cadre_temporel_etape_3, cadre_temporel_etape_4, cadre_temporel_etape_5, confidentialite, duree_strategique, duree_operationnel, id_projet_gen FROM F_projet WHERE F_projet.id_utilisateur=?");
    $search_projet->bindParam(1, $getid_utilisateur);
    $search_projet->execute();

    $array = array();

    while($ecriture = $search_projet->fetch()){
        array_push($array,$ecriture);
}
}

<<<<<<< HEAD
echo json_encode($array);


?>
=======
echo json_encode($array)

?>
>>>>>>> origin/Carlos
