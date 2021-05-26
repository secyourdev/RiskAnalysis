<?php
session_start();
include("../bdd/connexion.php");

  $results["error"] = false;

  $nom_grp_user=$_POST['nom_grp_user'];
  
  $inseregrpuser = $bdd->prepare('INSERT INTO `B_grp_utilisateur`(`nom_grp_utilisateur`) VALUES (?)');

  // Verification du nom du groupe utilisateur
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_grp_user)){
      $results["error"] = true;
      $_SESSION['message_error_2'] = "Nom invalide";
    }

    if ($results["error"] === false && isset($_POST['ajouter_grp_user'])){
      $inseregrpuser->bindParam(1, $nom_grp_user);
      $inseregrpuser->execute();
      $_SESSION['message_success_2'] = "Le groupe d'utilisateur a bien été crée !";
    }

    header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
?>