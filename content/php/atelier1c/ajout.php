<?php
header('Location: ../../../atelier-1c');

if (isset($_POST['valider'])){
  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios_rm_v5;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

  $results["error"] = false;
  $results["message"] = [];

  $nom_valeur_metier=$_POST['nom_valeur_metier'];
  $nom_evenement_redoutes=$_POST['nom_evenement_redoutes'];
  $description_evenement_redoutes=$_POST['description_evenement_redoutes'];
  $impact=$_POST['impact'];
  $confidentialite=$_POST['confidentialite']; 
  $integrite=$_POST['integrite'];
  $disponibilite=$_POST['disponibilite'];
  $tracabilite=$_POST['tracabilite'];
  $niveau_de_gravite=$_POST['niveau_de_gravite'];

  // Verification du nom_valeur_metier
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)){
      $results["error"] = true;
      $results["message"]["nom_valeur_metier"] = "nom_valeur_metier invalide";
      ?>
      <strong style="color:#FF6565;">nom_valeur_metier invalide </br></strong>
      <?php
    }

  // Verification du nom_evenement_redoutes
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_evenement_redoutes)){
      $results["error"] = true;
      $results["message"]["nom_evenement_redoutes"] = "nom_evenement_redoutes invalide";
      ?>
      <strong style="color:#FF6565;">nom_evenement_redoutes invalide </br></strong>
      <?php
    }

  // Verification du description_evenement_redoutes
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_evenement_redoutes)){
      $results["error"] = true;
      $results["message"]["description_evenement_redoutes"] = "description_evenement_redoutes invalide";
      ?>
      <strong style="color:#FF6565;">description_evenement_redoutes invalide </br></strong>
      <?php
    }
    
    // Verification du impact
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $impact)){
      $results["error"] = true;
      $results["message"]["impact"] = "impact invalide";
      ?>
      <strong style="color:#FF6565;">impact invalide </br></strong>
      <?php
    }
    
    // Verification du confidentialite
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $confidentialite)){
      $results["error"] = true;
      $results["message"]["confidentialite"] = "confidentialite invalide";
      ?>
      <strong style="color:#FF6565;">confidentialite invalide </br></strong>
      <?php
    }
    // Verification du integrite
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $integrite)){
      $results["error"] = true;
      $results["message"]["integrite"] = "integrite invalide";
      ?>
      <strong style="color:#FF6565;">integrite invalide </br></strong>
      <?php
    }
    
    // Verification du disponibilite
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $disponibilite)){
      $results["error"] = true;
      $results["message"]["disponibilite"] = "disponibilite invalide";
      ?>
      <strong style="color:#FF6565;">disponibilite invalide </br></strong>
      <?php
    }
    
    // Verification du tracabilite
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $tracabilite)){
      $results["error"] = true;
      $results["message"]["tracabilite"] = "tracabilite invalide";
      ?>
      <strong style="color:#FF6565;">tracabilite invalide </br></strong>
      <?php
    }
    // Verification du niveau_de_gravite
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $niveau_de_gravite)){
      $results["error"] = true;
      $results["message"]["niveau_de_gravite"] = "niveau_de_gravite invalide";
      ?>
      <strong style="color:#FF6565;">niveau_de_gravite invalide </br></strong>
      <?php
    }
    
    if ($results["error"] === false){
      $bdd->exec('INSERT INTO `evenement_redoutes`(
        `id_evenement_redoutes`, 
        `nom_valeur_metier`, 
        `nom_evenement_redoutes`, 
        `description_evenement_redoutes`, 
        `impact`,
        `confidentialite`, 
        `integrite`,
        `disponibilite`, 
        `tracabilite`, 
        `niveau_de_gravite`
        ) 
      VALUES (
        id_evenement_redoutes,
        "'.$nom_valeur_metier.'",
        "'.$nom_evenement_redoutes.'",
        "'.$description_evenement_redoutes.'",
        "'.$impact.'",
        "'.$confidentialite.'",
        "'.$integrite.'",
        "'.$disponibilite.'",
        "'.$tracabilite.'",
        "'.$niveau_de_gravite.'"
        )'
      );
      ?>
        <strong style="color:#4AD991;">L'événement redouté a bien été ajoutée !</br></strong>
        <?php
    }
  }
  ?>