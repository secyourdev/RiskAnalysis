<?php
session_start();

include("../bdd/connexion.php");

$id_projet = $_SESSION['id_projet'];

$update = $bdd->prepare("UPDATE F_projet SET id_echelle_vraisemblance = ? WHERE id_projet = ?");
$get_nb_niveau_echelle = $bdd->prepare("SELECT nb_niveau_echelle FROM DC_echelle_vraisemblance WHERE id_echelle = ? AND id_projet = $id_projet");
$updatescenar = $bdd->prepare("UPDATE U_scenario_operationnel SET vraisemblance = 4 WHERE vraisemblance = 5 AND id_projet = $id_projet");
$delete_vraisemblance = $bdd->prepare("DELETE FROM DB_bareme_risque WHERE vraisemblance = 5 AND id_projet = $id_projet");



if(isset($_POST['id_echelle'])){
    // Changer l'échelle active
    $id_echelle = $_POST['id_echelle'];
    $update->bindParam(1, $id_echelle);
    $update->bindParam(2, $id_projet);
    $update->execute();   
    //Si passage à une echelle de 4 alors mettre tous les vraisemblance des scenarios operationnels à 4  
    $get_nb_niveau_echelle->bindParam(1, $id_echelle);
    $get_nb_niveau_echelle->execute();
    $vraisemblance = $get_nb_niveau_echelle->fetch();
    if ($vraisemblance[0] === "4"){
        // Pour tous les scénarios opérationnels avec une vraisemblance à 5, la vraisemblance passe à 4
        $updatescenar->execute();
        // Supprimer le changement de couleur pour la colonne associée à vraisemblance égale 5
        $delete_vraisemblance->execute();
    }
    $_SESSION['message_success_3'] = "Echelle changée!";
}
