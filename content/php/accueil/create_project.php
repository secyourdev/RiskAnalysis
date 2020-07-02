<?php
session_start();
//Connexion à la base de donnee
try {
    $bdd = new PDO(
      'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v11;charset=utf8',
      'ebios-rm',
      'hLLFL\bsF|&[8=m8q-$j',
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
  } catch (PDOException $e) {
    die('Erreur :' . $e->getMessage());
  }

header('Location: ../../../creation_projet&'.$_SESSION['id_utilisateur']);


?>