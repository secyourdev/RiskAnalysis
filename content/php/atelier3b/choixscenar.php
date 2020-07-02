<?php
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v9;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$querysrov = $bdd->prepare("SELECT id_source_de_risque, description_source_de_risque, description_objectif_vise FROM SROV");
$queryer = $bdd->prepare("SELECT id_evenement_redoute, nom_evenement_redoute FROM evenement_redoute");
$querypp = $bdd->prepare("SELECT id_partie_prenante, nom_partie_prenante FROM partie_prenante");

$querysrov->execute();
$queryer->execute();
$querypp->execute();

$srov = $querysrov->fetchAll(PDO::FETCH_ASSOC);
$er = $queryer->fetchAll(PDO::FETCH_ASSOC);
$pp = $querypp->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($srov);
echo json_encode($er);
echo json_encode($pp);

// print_r($srov);
// print_r($er);
// print_r($pp);