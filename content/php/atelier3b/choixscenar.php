<?php

include("../bdd/connexion.php");

$querysrov = $bdd->prepare("SELECT id_source_de_risque, description_source_de_risque, description_objectif_vise FROM P_SROV");
$queryer = $bdd->prepare("SELECT id_evenement_redoute, nom_evenement_redoute FROM M_evenement_redoute");

$querysrov->execute();
$queryer->execute();

$srov = $querysrov->fetchAll(PDO::FETCH_ASSOC);
$er = $queryer->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($er);

print_r($er);