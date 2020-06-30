<?php
// header('Location: ../../../atelier-1b');


  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v11;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

  $results["error"] = false;
  $results["message"] = [];


  $nom_echelle=$_POST['nom_echelle'];
  $echelle_gravite=$_POST['echelle_gravite'];
  $echelle_vraisemblance=$_POST['echelle_vraisemblance'];
  $id_echelle="id_echelle";

  $insere = $bdd->prepare('INSERT INTO `echelle`(`id_echelle`, `nom_echelle`, `echelle_gravite`, `echelle_vraisemblance`) VALUES (?,?,?,?)');


    // Verification du nom de l'echelle
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_echelle)){
      $results["error"] = true;
      $results["message"]["nom"] = "Nom de l'échelle invalide";
      ?>
      <strong style="color:#FF6565;">Nom de l'échelle invalide </br></strong>
      <?php
    }

    if ($results["error"] === false && isset($_POST['validerechelle'])){
      $insere->bindParam(1, $id_echelle);
      $insere->bindParam(2, $nom_echelle);
      $insere->bindParam(3, $echelle_vraisemblance);
      $insere->bindParam(4, $echelle_gravite);
      $insere->execute();
      ?>
      <strong style="color:#4AD991;">L'échelle a bien été ajoutée !</br></strong>
      <?php
    }

?>