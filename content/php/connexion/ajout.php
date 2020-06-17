<?php

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

if (isset($_POST['connexion'])){
  $email = $_POST["email"];
  $mot_de_passe = $_POST["mot_de_passe"];
  $mot_de_passe = password_hash($mot_de_passe, PASSWORD_BCRYPT);
  $type_compte = 'admin';

  if ($results["error"] === false){
    $bdd->exec('INSERT INTO `utilisateur`(`id_utilisateur`, `email`, `mot_de_passe`, `type_compte`) VALUES (id_utilisateur,"'.$email.'","'.$mot_de_passe.'","'.$type_compte.'")');
    ?>
    <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
    <?php
  }
}
?>