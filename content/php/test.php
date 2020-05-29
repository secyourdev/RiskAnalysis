<?php

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$poste=$_POST['poste'];

//Connexion à la base de donnee
try{
  $bdd=new PDO('mysql:host=localhost;dbname=ebios_rm_v5;charset=utf8','root','',
  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

catch(PDOException $e){
  die('Erreur :'.$e->getMessage());
}

$bdd->exec('INSERT INTO `personne`(`id_personne`, `nom`, `prenom`, `poste`, `adresse_mail`) VALUES (id_personne,"'.$nom.'","'.$prenom.'","'.$poste.'", null)');
echo 'La personne a bien été ajouté !';

header('Location: ../../atelier-1a#acteurs');
?>






