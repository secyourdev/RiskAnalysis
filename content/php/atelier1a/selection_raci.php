<?php

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

$search_raci = $bdd->prepare("SELECT * FROM RACI");
$search_raci->execute();

$array = array();

while($ecriture = $search_raci->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)
?>