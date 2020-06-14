<?php
header('Location: ../../atelier-1a#acteurs');

if (isset($_POST['valider'])){
  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=localhost;dbname=ebios_rm_v5;charset=utf8','root','',
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
        $bdd->exec('INSERT INTO `personne`(`id_personne`, `nom`, `prenom`, `poste`, `adresse_mail`) VALUES (id_personne,"'.$nom.'","'.$prenom.'","'.$poste.'", null)');
        ?>
        <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
        <?php
    }
}
?>