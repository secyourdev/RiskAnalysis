<?php
session_start();

include("../bdd/connexion.php");

$id_etude_suppr = $_POST['id_etude_suppr'];

if(isset($_POST['supprimer_projet'])){
    $update_projet = $bdd->prepare("DELETE FROM projet WHERE id_projet=?");
    $update_projet->bindParam(1, $id_etude_suppr);
    $update_projet->execute();

    $_SESSION['message_success'] = "Le projet $id_etude_modif a été supprimé !";
}

header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
?>