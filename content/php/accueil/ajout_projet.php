<?php
//header('Location: ../../../index.php');
session_start();
  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v17;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

  $results["error"] = false;
  $results["message"] = [];

  $nom_etude=$_POST['nom_etude'];
  $objectif_atteindre=$_POST['objectif_atteindre'];
  $respo_acceptation_risque=$_POST['respo_acceptation_risque'];
  $cadre_temporel=$_POST['cadre_temporel'];
  $echelle='1';
  $nom_grp_utilisateur=$_POST['nom_grp_utilisateur'];

  $insereprojet = $bdd->prepare('INSERT INTO `projet`(`nom_projet`, `objectif_projet`, `responsable_risque_residuel`, `cadre_temporel`, `id_echelle`, `id_grp_utilisateur`) VALUES (?,?,?,?,?,?)');

  // Verification du nom du projet
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_etude)){
      $results["error"] = true;
      $results["message"]["nom"] = "Nom invalide";
      ?>
<strong style="color:#FF6565;">Nom invalide </br></strong>
<?php
    }

    // Verification de l'objectif du projet
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $objectif_atteindre)){
      $results["error"] = true;
      $results["message"]["objectif"] = "Objectif invalide";
      ?>
<strong style="color:#FF6565;">Objectif invalide </br></strong>
<?php
    }

    // Verification du nom du responsable du projet
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $respo_acceptation_risque)){
      $results["error"] = true;
      $results["message"]["responsable"] = "Responsable invalide";
      ?>
<strong style="color:#FF6565;">Nom du responsable invalide </br></strong>
<?php
    }

    // Verification du cadre temporel
    if(!preg_match("/^[0-9\s-]{1,100}$/", $cadre_temporel)){
        $results["error"] = true;
        $results["message"]["cadre_temporel"] = "Cadre temporel invalide";
        ?>
<strong style="color:#FF6565;">Cadre temporel invalide </br></strong>
<?php
      }

    // Verification du nom du responsable du projet
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_grp_utilisateur)){
      $results["error"] = true;
      $results["message"]["groupe_utilisateur"] = "Groupe d'utilisateur invalide";
      ?>
<strong style="color:#FF6565;">Groupe d'utilisateur invalide </br></strong>
<?php
    }

    if ($results["error"] === false && isset($_POST['ajouter_projet'])){
      $affiche_grp_user = $bdd->prepare("SELECT id_grp_utilisateur FROM grp_utilisateur WHERE nom_grp_utilisateur = ?");
      $affiche_grp_user->bindParam(1, $nom_grp_utilisateur);
      $affiche_grp_user->execute();
      $resultat = $affiche_grp_user->fetch();

      $insereprojet->bindParam(1, $nom_etude);
      $insereprojet->bindParam(2, $objectif_atteindre);
      $insereprojet->bindParam(3, $respo_acceptation_risque);
      $insereprojet->bindParam(4, $cadre_temporel);
      $insereprojet->bindParam(5, $echelle);
      $insereprojet->bindParam(6, $resultat[0]);
      $insereprojet->execute();

      $recupereprojet = $bdd->prepare("SELECT id_projet FROM projet WHERE nom_projet=? AND objectif_projet=?");
      $recupereprojet->bindParam(1, $nom_etude);
      $recupereprojet->bindParam(2, $objectif_atteindre);
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


      header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
    ?>
<strong style="color:#4AD991;">Le projet a bien été crée !</br></strong>
<?php
    }


?>