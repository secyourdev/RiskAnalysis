<?php

<<<<<<< HEAD
include("content/php/bdd/connexion.php");
=======
// include("../bdd/connexion.php");
>>>>>>> origin/Anthony

$results["error"] = false;
$results["message"] = [];
$recupere = $bdd->prepare("SELECT echelle_gravite FROM F_projet NATURAL JOIN D_echelle WHERE id_projet = ?");
$id_projet = $_SESSION['id_projet'];


if ($results["error"] === false) {
    $recupere->bindParam(1, $id_projet);
    $recupere->execute();
    $nbniveaugravite = $recupere->fetch();
}
