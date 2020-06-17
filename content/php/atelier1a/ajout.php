<?php
header('Location: ../../../atelier-1a#acteurs');

if (isset($_POST['valider'])){
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

  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $poste=$_POST['poste'];

  // Verification du nom
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom)){
      $results["error"] = true;
      $results["message"]["nom"] = "Nom invalide";
      ?>
      <strong style="color:#FF6565;">Nom invalide </br></strong>
      <?php
    }

  // Verification du prenom
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenom)){
      $results["error"] = true;
      $results["message"]["prenom"] = "Prenom invalide";
      ?>
      <strong style="color:#FF6565;">Prénom invalide </br></strong>
      <?php
    }

  // Verification du poste
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste)){
      $results["error"] = true;
      $results["message"]["poste"] = "Poste invalide";
      ?>
      <strong style="color:#FF6565;">Poste invalide </br></strong>
      <?php
    }

    if ($results["error"] === false){
        $bdd->exec('INSERT INTO `utilisateur`(`id_utilisateur`, `nom`, `prenom`, `poste`) VALUES (id_utilisateur,"'.$nom.'","'.$prenom.'","'.$poste.'")');
        ?>
        <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
        <?php
    }
}
?>