<?php

try {
    $bdd = new PDO(
        'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v14;charset=utf8',
        'ebios-rm',
        'hLLFL\bsF|&[8=m8q-$j',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    die('Erreur :' . $e->getMessage());
}

$update = $bdd->prepare("UPDATE projet SET id_echelle = ? WHERE id_projet = ?");
$get_id = $bdd->prepare("SELECT id_echelle FROM echelle WHERE nom_echelle = ?");
$get_gravite = $bdd->prepare("SELECT echelle_gravite FROM echelle WHERE id_echelle = ?");
$updateer = $bdd->prepare("UPDATE evenement_redoute SET niveau_de_gravite = 4 WHERE niveau_de_gravite = 5");
$id_projet = 1;


if(isset($_POST['nom_echelle'])){

    $nom_echelle = $_POST['nom_echelle'];
    // echo $nom_echelle;
    $get_id->bindParam(1, $nom_echelle);
    $get_id->execute();
    $id_echelle = $get_id->fetch();
    // echo $id_echelle[0];
    // print_r($id_echelle);
    $update->bindParam(1, $id_echelle[0]);
    $update->bindParam(2, $id_projet);
    $update->execute();
    echo $nom_echelle;
    $get_gravite->bindParam(1, $id_echelle[0]);
    $get_gravite->execute();
    $gravite = $get_gravite->fetch();
    if ($gravite[0] === "4"){
        $updateer->execute();
    }
    
    
    
}
