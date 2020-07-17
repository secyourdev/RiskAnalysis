<?php

session_start();
  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v20;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }
    $id_utilisateur=$_POST['id_utilisateur'];
    $nom_grp_utilisateur=$_POST['nom_grp_utilisateur'];
    
    $insereuser = $bdd->prepare('INSERT INTO `impliquer`(`id_grp_utilisateur`,`id_utilisateur`) VALUES (?,?)');

    $affiche_grp_user = $bdd->prepare("SELECT id_grp_utilisateur FROM grp_utilisateur WHERE nom_grp_utilisateur = ?");
    $affiche_grp_user->bindParam(1, $nom_grp_utilisateur);
    $affiche_grp_user->execute();
    $resultat = $affiche_grp_user->fetch();

    $insereuser->bindParam(1, $resultat[0]);
    $insereuser->bindParam(2, $id_utilisateur);
    $insereuser->execute();
?>