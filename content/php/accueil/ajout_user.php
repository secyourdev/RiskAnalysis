<?php

session_start();
include("../bdd/connexion.php");

    $id_utilisateur=$_POST['id_utilisateur'];
    $nom_grp_utilisateur=$_POST['nom_grp_utilisateur'];
    
    $insereuser = $bdd->prepare('INSERT INTO `C_impliquer`(`id_grp_utilisateur`,`id_utilisateur`) VALUES (?,?)');

    $affiche_grp_user = $bdd->prepare("SELECT id_grp_utilisateur FROM B_grp_utilisateur WHERE nom_grp_utilisateur = ?");
    $affiche_grp_user->bindParam(1, $nom_grp_utilisateur);
    $affiche_grp_user->execute();
    $resultat = $affiche_grp_user->fetch();

    $insereuser->bindParam(1, $resultat[0]);
    $insereuser->bindParam(2, $id_utilisateur);
    $insereuser->execute();

    $_SESSION['message_success_2b'] = "L'utilisateur a bien été ajouté !";

?>