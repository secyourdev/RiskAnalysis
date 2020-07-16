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
  $results["message"] = [];

  $nom_grp_user=$_POST['nom_grp_user'];
  
  $inseregrpuser = $bdd->prepare('INSERT INTO `grp_utilisateur`(`nom_grp_utilisateur`) VALUES (?)');

  // Verification du nom du groupe utilisateur
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_grp_user)){
      $results["error"] = true;
      $results["message"]["nom"] = "Nom invalide";
      ?>
<strong style="color:#FF6565;">Nom invalide </br></strong>
<?php
    }

    if ($results["error"] === false && isset($_POST['ajouter_grp_user'])){
      $inseregrpuser->bindParam(1, $nom_grp_user);
      $inseregrpuser->execute();
      header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
    ?>
<strong style="color:#4AD991;">Le groupe d'utilisateur a bien été crée !</br></strong>
<?php
    }


?>