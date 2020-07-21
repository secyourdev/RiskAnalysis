<?php
session_start();

include("../bdd/connexion.php");

$get_gravite = $bdd->prepare("SELECT echelle_gravite FROM D_echelle NATURAL JOIN F_projet WHERE id_projet = ?");

$id_projet = $_SESSION['id_projet'];

$get_gravite->bindParam(1, $id_projet);
$get_gravite->execute();
$gravite = $get_gravite->fetch();
echo $gravite[0];


