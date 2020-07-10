<?php

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

$search_grp_user = $bdd->prepare("SELECT * FROM grp_utilisateur");//WHERE raci = ANTHONY
$search_grp_user->execute();

$array = array();

while($ecriture = $search_grp_user->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>