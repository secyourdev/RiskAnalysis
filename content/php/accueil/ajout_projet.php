<?php

session_start();
  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v21;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

  $results["error"] = false;

  $nom_etude=$_POST['nom_etude'];
  $description_etude=$_POST['description_etude'];
  $echelle='1';
  $nom_grp_utilisateur=$_POST['nom_grp_utilisateur'];

  $insereprojet = $bdd->prepare('INSERT INTO `projet`(`nom_projet`, `description_projet`, `id_echelle`, `id_grp_utilisateur`) VALUES (?,?,?,?)');

  // Verification du nom du projet
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_etude)){
      $results["error"] = true;
      $_SESSION['message_error'] = "Nom invalide";
    }

    // Verification de l'description du projet
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $description_etude)){
      $results["error"] = true;
      $_SESSION['message_error'] = "Description invalide";
    }

    // Verification du nom du responsable du projet
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_grp_utilisateur)){
      $results["error"] = true;
      $_SESSION['message_error'] = "Groupe d'utilisateur invalide";
    }

    if ($results["error"] === false && isset($_POST['ajouter_projet'])){
      $affiche_grp_user = $bdd->prepare("SELECT id_grp_utilisateur FROM grp_utilisateur WHERE nom_grp_utilisateur = ?");
      $affiche_grp_user->bindParam(1, $nom_grp_utilisateur);
      $affiche_grp_user->execute();
      $resultat = $affiche_grp_user->fetch();

      $insereprojet->bindParam(1, $nom_etude);
      $insereprojet->bindParam(2, $description_etude);
      $insereprojet->bindParam(3, $echelle);
      $insereprojet->bindParam(4, $resultat[0]);
      $insereprojet->execute();

      $recupereprojet = $bdd->prepare("SELECT id_projet FROM projet WHERE nom_projet=? AND description_projet=?");
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
      $atelier3a = '3.a';
      $atelier3b = '3.b';
      $atelier3c = '3.c';
      $atelier4a = '4.a';
      $atelier4b = '4.b';
      $atelier5a = '5.a';
      $atelier5b = '5.b';
      $atelier5c = '5.c';
      $droit = 'Réalisation';
      $insertutilisateur = $bdd->prepare('INSERT INTO `RACI`(`id_projet`, `id_utilisateur`, `id_atelier`, `ecriture`) VALUES (?,?,?,?)');

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

      $_SESSION['message_success'] = "Le projet a bien été crée !";
    }
    
    header('Location: ../../../index&'.$_SESSION['id_utilisateur']);

?>