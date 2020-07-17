<?php
session_start();
try {
    $bdd = new PDO(
        'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v20;charset=utf8',
        'ebios-rm',
        'hLLFL\bsF|&[8=m8q-$j',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    die('Erreur :' . $e->getMessage());
}


$get_gravite = $bdd->prepare("SELECT echelle_gravite FROM echelle NATURAL JOIN projet WHERE id_projet = ?");

$id_projet = $_SESSION['id_projet'];



$get_gravite->bindParam(1, $id_projet);
$get_gravite->execute();
$gravite = $get_gravite->fetch();
echo $gravite[0];


