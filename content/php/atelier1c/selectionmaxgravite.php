<?php
// session_start();
try {
    $bdd = new PDO(
        'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v17;charset=utf8',
        'ebios-rm',
        'hLLFL\bsF|&[8=m8q-$j',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    die('Erreur :' . $e->getMessage());
}
$results["error"] = false;
$results["message"] = [];
$recupere = $bdd->prepare("SELECT echelle_gravite FROM projet NATURAL JOIN echelle WHERE id_projet = ?");
$id_projet = $_SESSION['id_projet'];


if ($results["error"] === false) {
    $recupere->bindParam(1, $id_projet);
    $recupere->execute();
    $nbniveaugravite = $recupere->fetch();
}
