<?php

try {
    $bdd = new PDO(
        'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v5;charset=utf8',
        'ebios-rm',
        'hLLFL\bsF|&[8=m8q-$j',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    die('Erreur :' . $e->getMessage());
}
$results["error"] = false;
$results["message"] = [];
$recupere = $bdd->prepare("SELECT valeur_max_gravite FROM projet");

if ($results["error"] === false) {
    $recupere->execute();
    $nbniveaugravite = $recupere->fetch();
}
