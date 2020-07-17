<?php
  session_start();
  $getid_projet = $_SESSION['id_projet'];
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v20;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$search_vm = $bdd->prepare("SELECT id_valeur_metier,nom_valeur_metier FROM valeur_metier WHERE id_projet=?");
$search_vm->bindParam(1,$getid_projet);
$search_vm->execute();

$array = array();

while($ecriture = $search_vm->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)

?>