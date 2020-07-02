<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v11;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

if(isset($_POST['nom_etude'])){
    $nom_etude = $_POST['nom_etude'];
    $update_projet = $bdd->prepare("UPDATE projet SET nom_projet = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $nom_etude);
    $update_projet->bindParam(2, $getid_projet);
    $update_projet->execute();
}

if(isset($_POST['objectif_atteindre'])){
    $objectif_atteindre = $_POST['objectif_atteindre'];
    $update_projet = $bdd->prepare("UPDATE projet SET objectif_projet = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $objectif_atteindre);
    $update_projet->bindParam(2, $getid_projet);
    $update_projet->execute();
}

if(isset($_POST['respo_acceptation_risque'])){
    $respo_acceptation_risque = $_POST['respo_acceptation_risque'];
    $update_projet = $bdd->prepare("UPDATE projet SET responsable_risque_residuel = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $respo_acceptation_risque);
    $update_projet->bindParam(2, $getid_projet);
    $update_projet->execute();
}

if(isset($_POST['radio_gravite'])){
    $radio_gravite = $_POST['radio_gravite'];
    $update_projet = $bdd->prepare("UPDATE projet SET valeur_max_gravite = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $radio_gravite);
    $update_projet->bindParam(2, $getid_projet);
    $update_projet->execute();
}

if(isset($_POST['cadre_temporel'])){
    $cadre_temporel = $_POST['cadre_temporel'];
    $update_projet = $bdd->prepare("UPDATE projet SET cadre_temporel = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $cadre_temporel);
    $update_projet->bindParam(2, $getid_projet);
    $update_projet->execute();
}

?>