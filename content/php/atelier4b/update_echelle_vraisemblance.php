<?php
session_start();

include("../bdd/connexion.php");

$update = $bdd->prepare("UPDATE F_projet SET id_echelle_vraisemblance = ? WHERE id_projet = ?");
$get_nb_niveau_echelle = $bdd->prepare("SELECT nb_niveau_echelle FROM DC_echelle_vraisemblance WHERE id_echelle = ?");
$updatescenar = $bdd->prepare("UPDATE U_scenario_operationnel SET vraisemblance = 4 WHERE vraisemblance = 5");
$id_projet = $_SESSION['id_projet'];

if(isset($_POST['id_echelle'])){
    // Changer l'échelle active
    $id_echelle = $_POST['id_echelle'];
    $update->bindParam(1, $id_echelle);
    $update->bindParam(2, $id_projet);
    $update->execute();   
    //Si passage à une echelle de 4 alors mettre tous les vraisemblance des scenario operationnel à 4  
    $get_nb_niveau_echelle->bindParam(1, $id_echelle);
    $get_nb_niveau_echelle->execute();
    $gravite = $get_nb_niveau_echelle->fetch();
    if ($gravite[0] === "4"){
        $updatescenar->execute();
    }
}
