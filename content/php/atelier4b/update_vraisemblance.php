<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
try {
    $bdd = new PDO(
        'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v21;charset=utf8',
        'ebios-rm',
        'hLLFL\bsF|&[8=m8q-$j',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    die('Erreur :' . $e->getMessage());
}


$get_id = $bdd->prepare("SELECT echelle.id_echelle FROM echelle NATURAL JOIN projet WHERE projet.id_projet = ?");

$updatevraisemblance = $bdd->prepare("UPDATE echelle SET echelle_vraisemblance = ? WHERE id_echelle = ?");
$updatescenar = $bdd->prepare("UPDATE scenario_operationnel SET vraisemblance = 4 WHERE vraisemblance = 5");



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
