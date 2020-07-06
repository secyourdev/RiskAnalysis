<?php
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v13;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$querysrov = $bdd->prepare("SELECT id_source_de_risque, description_source_de_risque, description_objectif_vise FROM SROV");
$queryer = $bdd->prepare("SELECT id_evenement_redoute, nom_evenement_redoute FROM evenement_redoute");

$querysrov->execute();
$queryer->execute();

$srov = $querysrov->fetchAll(PDO::FETCH_ASSOC);
$er = $queryer->fetchAll(PDO::FETCH_ASSOC);
// echo "[";
// echo json_encode($srov);
// echo ",";
echo json_encode($er);
// echo "]";

// print_r($srov);
print_r($er);