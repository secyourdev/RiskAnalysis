<?php
header('Location: ../../../index.php');

  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v6;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
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
  $radio_gravite=$_POST['radio_gravite'];
  $cadre_temporel=$_POST['cadre_temporel'];

  $insereprojet = $bdd->prepare('INSERT INTO `projet`(`nom_projet`, `objectif_projet`, `responsable_risque_residuel`,`valeur_max_gravite`, `cadre_temporel`) VALUES (?,?,?,?,?)');

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

    // Verification de l'échelle gravité
    if(!preg_match("/^[0-9]{1,100}$/", $radio_gravite)){
      $results["error"] = true;
      $results["message"]["gravite"] = "Gravité invalide";
      ?>
      <strong style="color:#FF6565;">Gravité invalide </br></strong>
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

    if ($results["error"] === false && isset($_POST['ajouter_projet'])){
      $insereprojet->bindParam(1, $nom_etude);
      $insereprojet->bindParam(2, $objectif_atteindre);
      $insereprojet->bindParam(3, $respo_acceptation_risque);
      $insereprojet->bindParam(4, $radio_gravite);
      $insereprojet->bindParam(5, $cadre_temporel);
      $insereprojet->execute();
    ?>
      <strong style="color:#4AD991;">Le projet a bien été crée !</br></strong>
      <?php
    }


?>