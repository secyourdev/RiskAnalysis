<?php
  session_start(); 
  $getid_projet = $_SESSION['id_projet'];

//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v17;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$search_raci = $bdd->prepare("SELECT * FROM RACI where id_projet=?");
$search_raci->bindParam(1, $getid_projet);
$search_raci->execute();

$array = array();

while($ecriture = $search_raci->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)
?>