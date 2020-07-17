<?php
session_start();

//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v21;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$id_etude_suppr = $_POST['id_etude_suppr'];

if(isset($_POST['supprimer_projet'])){
    $update_projet = $bdd->prepare("DELETE FROM projet WHERE id_projet=?");
    $update_projet->bindParam(1, $id_etude_suppr);
    $update_projet->execute();

    $_SESSION['message_success'] = "Le projet $id_etude_modif a été supprimé !";
}

header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
?>