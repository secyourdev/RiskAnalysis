<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
try {
    $bdd = new PDO(
        'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v18;charset=utf8',
        'ebios-rm',
        'hLLFL\bsF|&[8=m8q-$j',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    die('Erreur :' . $e->getMessage());
}
$get_gravite = $bdd->prepare("SELECT echelle_vraisemblance FROM echelle NATURAL JOIN projet WHERE id_projet = ?");


$get_vraisemblance->bindParam(1, $getid_projet);
$get_vraisemblance->execute();
$vraisemblance = $get_vraisemblance->fetch();
echo $vraisemblance[0];

    
    

