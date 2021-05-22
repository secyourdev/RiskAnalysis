<?php
session_start();
$getid_utilisateur = $_SESSION['id_utilisateur'];

include("../bdd/connexion.php");

// Recupérer tous les champs projets dans la version de projet courant.
// $search_projet = $bdd->prepare("SELECT DISTINCT id_projet,nom_projet,description_projet,cadre_temporel,cadre_temporel_etape_2,cadre_temporel_etape_3,cadre_temporel_etape_4,cadre_temporel_etape_5, confidentialite, duree_strategique, duree_operationnel FROM F_projet");
//TODO - A remettre à la place de la ligne précédente.
 $search_projet = $bdd->prepare("SELECT DISTINCT id_projet,nom_projet,description_projet,cadre_temporel,cadre_temporel_etape_2,cadre_temporel_etape_3,cadre_temporel_etape_4,cadre_temporel_etape_5, confidentialite, duree_strategique, duree_operationnel, F_projet.id_projet_gen, F_projet.id_version  FROM F_projet INNER JOIN ZD_projet_gen ON F_projet.id_projet = ZD_projet_gen.id_projet_desc_current ORDER BY F_projet.id_projet_gen ASC");

$search_projet->execute();

$array = array();

// Récupération du champ
$search_projet_version = $bdd->prepare("SELECT DISTINCT id_version, num_version FROM ZC_version INNER JOIN ZD_projet_gen ON ZC_version.id_projet = ZD_projet_gen.id_projet_desc_current ORDER BY ZC_version.id_projet_gen ASC");
$search_projet_version->execute();





while($ecriture = $search_projet->fetch()){
    $ecriture2 = $search_projet_version->fetch();
    array_push($array,$ecriture+$ecriture2);
}


echo json_encode($array)

?>
