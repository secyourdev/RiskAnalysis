<?php

session_start();
include("../bdd/connexion.php");

  $results["error"] = false;

  $nom_etude=$_POST['nom_etude'];
  $description_etude=$_POST['description_etude'];
  $id_grp_utilisateur=$_POST['id_grp_utilisateur'];
  $chef_de_projet=$_POST['id_utilisateur'];
  $id_echelle_projet = '1';

  $insereprojet = $bdd->prepare('INSERT INTO `F_projet`(`nom_projet`, `description_projet`, `id_grp_utilisateur`, `id_utilisateur`, `id_echelle` ) VALUES (?,?,?,?,?)');

  // Verification du nom du projet
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $nom_etude)){
      $results["error"] = true;
      $_SESSION['message_error'] = "Nom invalide";
    }

    // Verification de l'description du projet
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,1000}$/", $description_etude)){
      $results["error"] = true;
      $_SESSION['message_error'] = "Description invalide";
    }

    if ($results["error"] === false && isset($_POST['ajouter_projet'])){
      $insereprojet->bindParam(1, $nom_etude);
      $insereprojet->bindParam(2, $description_etude);
      $insereprojet->bindParam(3, $id_grp_utilisateur);
      $insereprojet->bindParam(4, $chef_de_projet);
      $insereprojet->bindParam(5, $id_echelle_projet);
      $insereprojet->execute();

      $recupereprojet = $bdd->prepare("SELECT id_projet FROM F_projet WHERE nom_projet=? AND description_projet=?");
      $recupereprojet->bindParam(1, $nom_etude);
      $recupereprojet->bindParam(2, $description_etude);
      $recupereprojet->execute();
      $resultat2 = $recupereprojet->fetch();

      $id_utilisateur=$_SESSION['id_utilisateur'];
      $id_projet = $resultat2[0];
      $atelier1a = '1.a';
      $atelier1b = '1.b';
      $atelier1c = '1.c';
      $atelier1d = '1.d';
      $atelier2a = '2.a';
      $atelier2b = '2.b';
      $atelier2c = '2.c';
      $atelier3a = '3.a';
      $atelier3b = '3.b';
      $atelier3c = '3.c';
      $atelier4a = '4.a';
      $atelier4b = '4.b';
      $atelier5a = '5.a';
      $atelier5b = '5.b';
      $atelier5c = '5.c';
      $droit = 'Réalisation';
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
      $insertutilisateur->bindParam(3, $atelier2c);
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

      $seuil_danger = 6;
      $seuil_controle = 4;
      $seuil_veille = 2;
      $insereseuil = $bdd->prepare("INSERT INTO Q_seuil (seuil_danger, seuil_controle, seuil_veille, id_projet, id_atelier) VALUES (?,?,?,?,?)");
      $insereseuil->bindParam(1, $seuil_danger);
      $insereseuil->bindParam(2, $seuil_controle);
      $insereseuil->bindParam(3, $seuil_veille);
      $insereseuil->bindParam(4, $id_projet);
      $insereseuil->bindParam(5, $atelier3a);
      $insereseuil->execute();      

      $id_echelle = '1';
      $insereechelle = $bdd->prepare("INSERT INTO DA_evaluer (id_echelle, id_projet) VALUES (?,?)");
      $insereechelle->bindParam(1, $id_echelle);
      $insereechelle->bindParam(2, $id_projet);
      $insereechelle->execute();     

      $_SESSION['message_success'] = "Le projet a bien été crée !";
    }
    
    header('Location: ../../../index&'.$_SESSION['id_utilisateur']);

?>