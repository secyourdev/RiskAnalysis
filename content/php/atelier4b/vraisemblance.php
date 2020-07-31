<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$get_vraisemblance = $bdd->prepare("SELECT echelle_vraisemblance FROM DA_echelle NATURAL JOIN F_projet WHERE id_projet = ?");


$get_vraisemblance->bindParam(1, $getid_projet);
$get_vraisemblance->execute();
$vraisemblance = $get_vraisemblance->fetch();

    
    

