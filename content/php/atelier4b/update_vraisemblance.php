<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$get_id = $bdd->prepare("SELECT D_echelle.id_echelle FROM D_echelle NATURAL JOIN F_projet WHERE F_projet.id_projet = ?");

$updatevraisemblance = $bdd->prepare("UPDATE D_echelle SET echelle_vraisemblance = ? WHERE id_echelle = ?");
$updatescenar = $bdd->prepare("UPDATE U_scenario_operationnel SET vraisemblance = 4 WHERE vraisemblance = 5");



if(isset($_POST['vraisemblance'])){

    $vraisemblance = $_POST['vraisemblance'];
    // echo $vraisemblance;
    $get_id->bindParam(1, $get_id_projet);
    $get_id->execute();
    $id_echelle = $get_id->fetch();
    // echo $id_echelle[0];
    // print_r($id_echelle);
    $updatevraisemblance->bindParam(1, $vraisemblance);
    $updatevraisemblance->bindParam(2, $id_echelle[0]);
    $updatevraisemblance->execute();
    if ($vraisemblance === "4"){
        $updatescenar->execute();
    }
}
