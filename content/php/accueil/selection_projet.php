<?php
session_start();
$getid_utilisateur = $_SESSION['id_utilisateur'];
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v14;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$search_projet = $bdd->prepare("SELECT DISTINCT id_projet,nom_projet,objectif_projet,cadre_temporel FROM RACI NATURAL JOIN projet WHERE id_utilisateur=?");
$search_projet->bindParam(1, $getid_utilisateur);
$search_projet->execute();

$array = array();

while($ecriture = $search_projet->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>