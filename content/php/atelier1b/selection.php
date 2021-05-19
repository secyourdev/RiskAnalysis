<?php
<<<<<<< HEAD
// $getid_projet = intval($_GET['id_projet']);
$getid_projet = $_SESSION['id_projet'];
=======
$getid_projet = intval($_GET['id_projet']);
>>>>>>> origin/Carlos
include("content/php/bdd/connexion_sqli.php");

$query1 = "SELECT I_mission.id_mission,I_mission.nom_mission,I_mission.description_mission,I_mission.responsable,J_valeur_metier.nom_valeur_metier,L_couple_VMBS.nom_responsable_vm,K_bien_support.nom_bien_support,L_couple_VMBS.nom_responsable_bs FROM `L_couple_VMBS` NATURAL JOIN I_mission NATURAL JOIN J_valeur_metier NATURAL JOIN K_bien_support WHERE I_mission.id_projet=$getid_projet ORDER BY I_mission.id_mission ASC";
$result1 = mysqli_query($connect, $query1);

$query2 = "SELECT * FROM J_valeur_metier WHERE J_valeur_metier.id_projet = $getid_projet ORDER BY J_valeur_metier.id_valeur_metier ASC";
$result2 = mysqli_query($connect, $query2);

$query3 = "SELECT * FROM K_bien_support WHERE K_bien_support.id_projet = $getid_projet ORDER BY K_bien_support.id_bien_support ASC";
$result3 = mysqli_query($connect, $query3);

$queryvm = "SELECT id_valeur_metier,nom_valeur_metier FROM J_valeur_metier WHERE id_projet = $getid_projet";
$resultvm = mysqli_query($connect, $queryvm);

$querybien = "SELECT id_bien_support,nom_bien_support FROM K_bien_support WHERE id_projet = $getid_projet";
$resultbien = mysqli_query($connect, $querybien);

$querymission = "SELECT DISTINCT I_mission.id_mission, I_mission.nom_mission, I_mission.description_mission FROM I_mission WHERE id_projet=$getid_projet";
$resultmission = mysqli_query($connect, $querymission);
<<<<<<< HEAD

$rq_vm = "SELECT nom_valeur_metier, nature_valeur_metier, description_valeur_metier FROM J_valeur_metier WHERE id_projet=$getid_projet";
$rq_vm_tab = mysqli_query($connect, $rq_vm);

$rq_biens = "SELECT nom_bien_support, description_bien_support FROM K_bien_support WHERE id_projet=$getid_projet";
$rq_biens_tab =  mysqli_query($connect, $rq_biens);

$rq_mission = "SELECT nom_mission AS 'Nom de la mission', description_mission AS 'Description de la mission', responsable AS 'Responsable', nom_valeur_metier AS 'Valeur Métier', nom_responsable_vm AS 'Responsable de la valeur métier', nom_bien_support AS 'Bien Support', nom_responsable_bs AS 'Responsable du bien support' FROM I_mission NATURAL JOIN J_valeur_metier NATURAL JOIN K_bien_support NATURAL JOIN L_couple_VMBS WHERE id_projet=$getid_projet";
$rq_mission_tab = mysqli_query($connect, $rq_mission);
=======
>>>>>>> origin/Carlos
