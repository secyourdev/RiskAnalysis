<?php

include("content/php/bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];
$recupere = $bdd->prepare("SELECT echelle_gravite FROM F_projet NATURAL JOIN DA_echelle WHERE id_projet = ?");
$id_projet = $_SESSION['id_projet'];


if ($results["error"] === false) {
    $recupere->bindParam(1, $id_projet);
    $recupere->execute();
    $nbniveaugravite = $recupere->fetch();
}
