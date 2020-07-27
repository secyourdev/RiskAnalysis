<?php

session_start();
include("../bdd/connexion.php");

  $results["error"] = false;

  $nom_etude=$_POST['nom_etude'];
  $description_etude=$_POST['description_etude'];
  $id_grp_utilisateur=$_POST['id_grp_utilisateur'];
  $chef_de_projet=$_POST['id_utilisateur'];

  $insereprojet = $bdd->prepare('INSERT INTO `F_projet`(`nom_projet`, `description_projet`, `id_grp_utilisateur`, `id_utilisateur`) VALUES (?,?,?,?)');

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

    if ($results["error"] === false && isset($_POST['ajouter_projet'])){
      $insereprojet->bindParam(1, $nom_etude);
      $insereprojet->bindParam(2, $description_etude);
      $insereprojet->bindParam(3, $id_grp_utilisateur);
      $insereprojet->bindParam(4, $chef_de_projet);
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

      $nom_echelle = 'Standard';
      $echelle_vraisemblance = '5';
      $echelle_gravite = '5';
      $insereechelle = $bdd->prepare("INSERT INTO DA_echelle (nom_echelle, echelle_vraisemblance, echelle_gravite, id_projet) VALUES (?,?,?,?)");
      $insereechelle->bindParam(1, $nom_echelle);
      $insereechelle->bindParam(2, $echelle_vraisemblance);
      $insereechelle->bindParam(3, $echelle_gravite);
      $insereechelle->bindParam(4, $id_projet);
      $insereechelle->execute();     

      $recupereechelle = $bdd->prepare("SELECT id_echelle FROM DA_echelle WHERE nom_echelle=? AND echelle_vraisemblance=? AND echelle_gravite=? AND id_projet=?");
      $recupereechelle->bindParam(1, $nom_echelle);
      $recupereechelle->bindParam(2, $echelle_vraisemblance);
      $recupereechelle->bindParam(3, $echelle_gravite);
      $recupereechelle->bindParam(4, $id_projet);
      $recupereechelle->execute();
      $resultat3 = $recupereechelle->fetch();

      $description_niveau_1 = "Conséquences négligeables pour l'organisation. Aucun impact opérationnel ni sur les performances de l'activité ni sur la sécurité des personnes et des biens. L'organisation surmontera la situation sans trop de difficultés (consommation des marges).";
      $description_niveau_2 = "Conséquences significatives mais limitées pour l'organisation. Dégradation des performances de l’activité sans impact sur la sécurité des personnes et des biens. L'organisation surmontera la situation malgré quelques difficultés (fonctionnement en mode dégradé).";
      $description_niveau_3 = "Conséquences importantes pour l'organisation. Forte dégradation des performances de l'activité, avec d’éventuels impacts significatifs sur la sécurité des personnes et des biens. L'organisation surmontera la situation avec de sérieuses difficultés (fonctionnement en mode très dégradé), sans impact sectoriel ou étatique.";
      $description_niveau_4 = "Conséquences désastreuses pour l'organisation avec d'éventuels impacts sur l'écosystème. Incapacité pour l'organisation d'assurer la totalité ou une partie de son activité, avec d'éventuels impacts graves sur la sécurité des personnes et des biens. L'organisation ne surmontera vraisemblablement pas la situation (sa survie est menacée), les secteurs d'activité ou étatiques dans lesquels elle opère seront susceptibles d’être légèrement impactés, sans conséquences durables.";
      $description_niveau_5 = "Conséquences sectorielles ou régaliennes au-delà de l'organisation. Écosystème(s) sectoriel(s) impacté(s) de façon importante, avec des conséquences éventuellement durables. Et/ou : difficulté pour l'État, voire incapacité, d'assurer une fonction régalienne ou une de ses missions d'importance vitale. Et/ou : impacts critiques sur la sécurité des personnes et des biens (crise sanitaire, pollution environnementale majeure, destruction d'infrastructures essentielles, etc.).";

      $valeur_niveau_1 = '1';
      $valeur_niveau_2 = '2';
      $valeur_niveau_3 = '3';
      $valeur_niveau_4 = '4';
      $valeur_niveau_5 = '5';


      $insereniveau = $bdd->prepare("INSERT INTO DA_niveau (description_niveau, valeur_niveau, id_echelle) VALUES (?,?,?)");
      
      $insereniveau->bindParam(1, $description_niveau_1);
      $insereniveau->bindParam(2, $valeur_niveau_1);
      $insereniveau->bindParam(3, $resultat3[0]);
      $insereniveau->execute();  
      
      $insereniveau->bindParam(1, $description_niveau_2);
      $insereniveau->bindParam(2, $valeur_niveau_2);
      $insereniveau->bindParam(3, $resultat3[0]);
      $insereniveau->execute();

      $insereniveau->bindParam(1, $description_niveau_3);
      $insereniveau->bindParam(2, $valeur_niveau_3);
      $insereniveau->bindParam(3, $resultat3[0]);
      $insereniveau->execute();

      $insereniveau->bindParam(1, $description_niveau_4);
      $insereniveau->bindParam(2, $valeur_niveau_4);
      $insereniveau->bindParam(3, $resultat3[0]);
      $insereniveau->execute();

      $insereniveau->bindParam(1, $description_niveau_5);
      $insereniveau->bindParam(2, $valeur_niveau_5);
      $insereniveau->bindParam(3, $resultat3[0]);
      $insereniveau->execute();

      $_SESSION['message_success'] = "Le projet a bien été crée !";
    }
    
    header('Location: ../../../index&'.$_SESSION['id_utilisateur']);

?>