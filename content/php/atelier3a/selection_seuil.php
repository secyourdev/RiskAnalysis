<?php
session_start();
$id_atelier = '3.a';
$id_projet = $_SESSION['id_projet'];
print $id_projet;
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v18;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$recupere_seuil = $bdd->prepare("SELECT * FROM seuil WHERE id_atelier = '$id_atelier' AND id_projet = $id_projet");
$recupere_seuil->execute();

$array = array();

while($seuil = $recupere_seuil->fetch()){
    array_push($array, $seuil);
}

echo json_encode($array)
?>