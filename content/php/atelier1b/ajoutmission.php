<?php
header('Location: ../../../atelier-1b');


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

  $mission=$_POST['mission'];
  $nomresponsable=$_POST['nomresponsable'];
  $prenomresponsable=$_POST['prenomresponsable'];
  $poste=$_POST['poste'];
  $id_mission="id_mission";
  $id_atelier="1.b";
  $recupere = $bdd->prepare('SELECT id_personne FROM personne WHERE nom = ? AND prenom = ? AND poste = ?');
  $insere = $bdd->prepare('INSERT INTO `mission`(`id_mission`, `nom_mission`, `id_atelier`, `id_personne`) VALUES (?,?,?,?)');



  // Verification du nom de la mission
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $mission)){
      $results["error"] = true;
      $results["message"]["nom"] = "Nom invalide";
      ?>
      <strong style="color:#FF6565;">Nom invalide </br></strong>
      <?php
    }

  // Verification du nom du responsable de la mission
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nomresponsable)){
      $results["error"] = true;
      $results["message"]["prenom"] = "Nom du responsable invalide";
      ?>
      <strong style="color:#FF6565;">Nom du responsable invalide </br></strong>
      <?php
    }

    // Verification du prénom du responsable de la mission
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenomresponsable)){
      $results["error"] = true;
      $results["message"]["prenom"] = "Prénom du responsable invalide";
      ?>
      <strong style="color:#FF6565;">Prénom du responsable invalide </br></strong>
      <?php
    }

  // Verification du poste du responsable de la mission
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste)){
      $results["error"] = true;
      $results["message"]["poste"] = "Poste invalide";
      ?>
      <strong style="color:#FF6565;">Poste invalide </br></strong>
      <?php
    }

    

    if ($results["error"] === false && isset($_POST['validermission'])){
        $recupere->bindParam(1, $nomresponsable);
        $recupere->bindParam(2, $prenomresponsable);
        $recupere->bindParam(3, $poste);
        $recupere->execute();
        $id_personne = $recupere->fetch();
        $insere->bindParam(1, $id_mission);
        $insere->bindParam(2, $mission);
        $insere->bindParam(3, $id_atelier);
        $insere->bindParam(4, $id_personne[0]);
        $insere->execute();
        ?>
        <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
        <?php
    }


?>