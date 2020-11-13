<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$get_id_echelle_vraisemblance = $bdd->prepare("SELECT `id_echelle_vraisemblance` FROM `F_projet` WHERE `id_projet` = ?");
$get_id_echelle_vraisemblance->bindParam(1, $getid_projet);
$get_id_echelle_vraisemblance->execute();
$id_echelle_vraisemblance = $get_id_echelle_vraisemblance->fetch();

$get_vraisemblance = $bdd->prepare("SELECT `id_echelle`,`nb_niveau_echelle` FROM `DC_echelle_vraisemblance` WHERE `id_echelle` = ?");
$get_vraisemblance->bindParam(1, $id_echelle_vraisemblance[0]);
$get_vraisemblance->execute();
$vraisemblance = $get_vraisemblance->fetch();

$array = array();

array_push($array,$vraisemblance);

echo json_encode($array) ;  
    

