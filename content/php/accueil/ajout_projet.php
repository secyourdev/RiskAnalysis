<?php

session_start();
include("../bdd/connexion.php");

  $results["error"] = false;

  $nom_etude=$_POST['nom_etude'];
  $description_etude=$_POST['description_etude'];
  $id_grp_utilisateur=$_POST['id_grp_utilisateur'];
  $chef_de_projet=$_POST['id_utilisateur'];
  $id_echelle_projet = '1';

  $insereprojet = $bdd->prepare('INSERT INTO `F_projet`(`nom_projet`, `description_projet`, `id_grp_utilisateur`, `id_utilisateur`, `id_echelle`,`id_version`, `id_projet_gen` ) VALUES (?,?,?,?,?,?,?)');
  $insereprojet_2 = $bdd->prepare('INSERT INTO `F_projet`(`nom_projet`, `description_projet`, `id_utilisateur`, `id_echelle`,`id_version`, `id_projet_gen` ) VALUES (?,?,?,?,?,?)');

  // Verification du nom du projet
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_etude)){
      $results["error"] = true;
      $_SESSION['message_error'] = "Nom invalide";
    }

    // Verification de l'description du projet
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $description_etude)){
      $results["error"] = true;
      $_SESSION['message_error'] = "Description invalide";
    }

    // Créer un nouveau projet_gen
     $query_projet_gen = $bdd->prepare('INSERT INTO `ZD_projet_gen` (`id_projet_desc_current`) VALUES (?)');
     $default_value = "0";
     $query_projet_gen->bindParam(1, $default_value);
     $query_projet_gen->execute();  

    // Récupérer l'id_projet_gen - Trier le résultat pour avoir la version la plus récente d'abord
    $query_id_projet_gen = $bdd->prepare('SELECT `id_projet_gen` FROM `ZD_projet_gen` WHERE `id_projet_desc_current`=? ORDER BY `id_projet_gen` DESC');
    $query_id_projet_gen->bindParam(1, $default_value);
    $query_id_projet_gen->execute();     
    $projet_get_id_projet_gen = $query_id_projet_gen->fetch(PDO::FETCH_ASSOC); 

    // Créer une nouvelle version
    $Desc_defaut = "Première version";
    $query_new_version = $bdd->prepare('INSERT INTO `ZC_version` (`num_version`, `description_version`, `id_projet_gen`, `id_projet`) VALUES (?,?,?,?)');
    $query_new_version->bindParam(1, $default_value);
    $query_new_version->bindParam(2, $Desc_defaut);
    $query_new_version->bindParam(3, $projet_get_id_projet_gen["id_projet_gen"]);
    $query_new_version->bindParam(4, $default_value);
    $query_new_version->execute();

    // Récupérer l'id de la nouvelle version - Trier le résultat pour avoir la version la plus récente d'abord
    $query_id_version = $bdd->prepare('SELECT `id_version` FROM `ZC_version` WHERE `id_projet_gen`=? ORDER BY `id_version` DESC');
    $query_id_version->bindParam(1, $projet_get_id_projet_gen["id_projet_gen"]);
    $query_id_version->execute();     
    $projet_get_id_version = $query_id_version->fetch(PDO::FETCH_ASSOC);

    if ($results["error"] === false && isset($_POST['ajouter_projet'])){
      if($id_grp_utilisateur!=""){
        $insereprojet->bindParam(1, $nom_etude);
        $insereprojet->bindParam(2, $description_etude);
        $insereprojet->bindParam(3, $id_grp_utiliseur);
        $insereprojet->bindParam(4, $chef_de_projet);
        $insereprojet->bindParam(5, $id_echelle_projet);
        $insereprojet->bindParam(6, $projet_get_id_version["id_version"]);
        $insereprojet->bindParam(7, $projet_get_id_projet_gen["id_projet_gen"]);
        $insereprojet->execute();
      }
      else{
        $insereprojet_2->bindParam(1, $nom_etude);
        $insereprojet_2->bindParam(2, $description_etude);
        $insereprojet_2->bindParam(3, $chef_de_projet);
        $insereprojet_2->bindParam(4, $id_echelle_projet);
        $insereprojet_2->bindParam(5, $projet_get_id_version["id_version"]);
        $insereprojet_2->bindParam(6, $projet_get_id_projet_gen["id_projet_gen"]);
        $insereprojet_2->execute();
      }

      $recupereprojet = $bdd->prepare("SELECT id_projet FROM F_projet WHERE nom_projet=? AND description_projet=?");
      $recupereprojet->bindParam(1, $nom_etude);
      $recupereprojet->bindParam(2, $description_etude);
      $recupereprojet->execute();
      $resultat2 = $recupereprojet->fetch();
      $id_projet = $resultat2[0];

      // Mettre à jour l'id_projet dans la table ZC_version
      $Desc_defaut_version = "01.01";
      $query_version_update = $bdd->prepare('UPDATE ZC_version SET id_projet = ?, num_version = ?  WHERE id_version = ?');
      $query_version_update->bindParam(1, $id_projet);
      $query_version_update->bindParam(2, $Desc_defaut_version);
      $query_version_update->bindParam(3, $projet_get_id_version["id_version"]); 
      $query_version_update->execute();

      // Mettre à jour l'id_projet dans la table ZD_projet_gen
      $query_projet_update = $bdd->prepare('UPDATE ZD_projet_gen SET id_projet_desc_current = ?  WHERE id_projet_gen= ?');
      $query_projet_update->bindParam(1, $id_projet);
      $query_projet_update->bindParam(2, $projet_get_id_projet_gen["id_projet_gen"]); 
      $query_projet_update->execute();

      // Récupérer l'id utilisateur
      $id_utilisateur=$_SESSION['id_utilisateur'];
      
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