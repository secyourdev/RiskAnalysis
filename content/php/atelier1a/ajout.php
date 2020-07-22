<?php
session_start();

include("../bdd/connexion.php");

  $results["error"] = false;
  $results["message"] = [];

  $id_utilisateur=$_POST['id_utilisateur'];
  $id_projet = $_SESSION['id_projet'];
  $atelier1a = '1.a';
  $atelier1b = '1.b';
  $atelier1c = '1.c';
  $atelier1d = '1.d';
  $atelier2a = '2.a';
  $atelier2b = '2.b';
  $atelier3a = '3.a';
  $atelier3b = '3.b';
  $atelier3c = '3.c';
  $atelier4a = '4.a';
  $atelier4b = '4.b';
  $atelier5a = '5.a';
  $atelier5b = '5.b';
  $atelier5c = '5.c';
  $droit = 'Information';
  $insertutilisateur = $bdd->prepare('INSERT INTO `H_RACI`(`id_projet`, `id_utilisateur`, `id_atelier`, `ecriture`) VALUES (?,?,?,?)');

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier1a);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier1b);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier1c);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier1d);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier2a);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier2b);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier3a);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier3b);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier3c);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier4a);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier4b);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier5a);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      
  
  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier5b);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      

  $insertutilisateur->bindParam(1, $id_projet);
  $insertutilisateur->bindParam(2, $id_utilisateur);
  $insertutilisateur->bindParam(3, $atelier5c);
  $insertutilisateur->bindParam(4, $droit);
  $insertutilisateur->execute();      


  
?>