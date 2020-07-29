<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

$query1 = "SELECT I_mission.id_mission,I_mission.nom_mission,I_mission.responsable,J_valeur_metier.nom_valeur_metier,L_couple_VMBS.nom_responsable_vm,K_bien_support.nom_bien_support,L_couple_VMBS.nom_responsable_bs FROM `L_couple_VMBS` NATURAL JOIN I_mission NATURAL JOIN J_valeur_metier NATURAL JOIN K_bien_support WHERE I_mission.id_projet=$getid_projet ORDER BY I_mission.id_mission ASC";
$result1 = mysqli_query($connect, $query1);

$query2 = "SELECT * FROM J_valeur_metier WHERE J_valeur_metier.id_projet = $getid_projet ORDER BY J_valeur_metier.id_valeur_metier ASC";
$result2 = mysqli_query($connect, $query2);

$query3 = "SELECT * FROM K_bien_support WHERE K_bien_support.id_projet = $getid_projet ORDER BY K_bien_support.id_bien_support ASC";
$result3 = mysqli_query($connect, $query3);

$queryvm = "SELECT id_valeur_metier,nom_valeur_metier FROM J_valeur_metier WHERE id_projet = $getid_projet";
$resultvm = mysqli_query($connect, $queryvm);

$querybien = "SELECT id_bien_support,nom_bien_support FROM K_bien_support WHERE id_projet = $getid_projet";
$resultbien = mysqli_query($connect, $querybien);

$querymission = "SELECT DISTINCT I_mission.id_mission, I_mission.nom_mission FROM I_mission WHERE id_projet=$getid_projet";
$resultmission = mysqli_query($connect, $querymission);
