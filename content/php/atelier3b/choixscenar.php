<?php

include("../bdd/connexion.php");

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