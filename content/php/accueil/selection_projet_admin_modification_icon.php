<?php
session_start();
$getid_utilisateur = $_SESSION['id_utilisateur'];
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v21;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$id_projet = $_POST['id_projet'];

$search_projet = $bdd->prepare("SELECT nom_projet,description_projet,id_grp_utilisateur FROM projet WHERE id_projet=?");
$search_projet->bindParam(1,$id_projet);
$search_projet->execute();

$array = array();

while($ecriture = $search_projet->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>


