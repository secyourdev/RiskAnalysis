<?php
header('Location: ../../../atelier-1b');


  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v5;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

  $results["error"] = false;
  $results["message"] = [];


  $nomvm=$_POST['nomvm'];
  $nature=$_POST['nature'];
  $descriptionvm=$_POST['descriptionvm'];
  $nomresponsablevm=$_POST['nomresponsablevm'];
  $prenomresponsablevm=$_POST['prenomresponsablevm'];
  $posteresponsablevm=$_POST['posteresponsablevm'];
  $id_personne="id_personne";
  $adresse_mail=NULL;
  $id_valeur_metier="valeur_metier";
  $id_atelier="1.b";


  $recupere = $bdd->prepare('SELECT id_personne FROM personne WHERE nom = ? AND prenom = ? AND poste = ?');
  $inserepersonne = $bdd->prepare('INSERT INTO `personne`(`id_personne`, `nom`, `prenom`, `poste`, `adresse_mail`) VALUES (?,?,?,?,?)');
  $inserevm = $bdd->prepare('INSERT INTO `valeur_metier`(`id_valeur_metier`, `nom_valeur_metier`, `nature_valeur_metier`, `description_valeur_metier`, `id_atelier`, `id_personne`) VALUES (?,?,?,?,?,?)');





    // Verification du nom de la valeur métier
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nomvm)){
      $results["error"] = true;
      $results["message"]["nom"] = "Nom invalide";
      ?>
      <strong style="color:#FF6565;">Nom invalide </br></strong>
      <?php
    }

    // Verification de la description de la valeur métier
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $descriptionvm)){
      $results["error"] = true;
      $results["message"]["nom"] = "Description invalide";
      ?>
      <strong style="color:#FF6565;">Description invalide </br></strong>
      <?php
    }

    // Verification du nom du responsable de la valeur métier
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nomresponsablevm)){
      $results["error"] = true;
      $results["message"]["nom"] = "Responsable invalide";
      ?>
      <strong style="color:#FF6565;">Nom du responsable invalide </br></strong>
      <?php
    }

    // Verification du prenom responsable de la valeur métier
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenomresponsablevm)){
      $results["error"] = true;
      $results["message"]["nom"] = "Responsable invalide";
      ?>
      <strong style="color:#FF6565;">Prénom du responsable invalide </br></strong>
      <?php
    }


    if ($results["error"] === false && isset($_POST['validervm'])){
      $inserepersonne->bindParam(1, $id_personne);
      $inserepersonne->bindParam(2, $nomresponsablevm);
      $inserepersonne->bindParam(3, $prenomresponsablevm);
      $inserepersonne->bindParam(4, $posteresponsablevm);
      $inserepersonne->bindParam(5, $adresse_mail);
      $inserepersonne->execute();
      $recupere->bindParam(1, $nomresponsablevm);
      $recupere->bindParam(2, $prenomresponsablevm);
      $recupere->bindParam(3, $posteresponsablevm);
      $recupere->execute();
      $id_personne = $recupere->fetch();
      $inserevm->bindParam(1, $id_valeur_metier);
      $inserevm->bindParam(2, $nomvm);
      $inserevm->bindParam(3, $nature);
      $inserevm->bindParam(4, $descriptionvm);
      $inserevm->bindParam(5, $id_atelier);
      $inserevm->bindParam(6, $id_personne[0]);
      $inserevm->execute();
    ?>
      <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
      <?php
    }


?>