<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

<<<<<<< HEAD
$querylegende = "SELECT DISTINCT id_risque, nom_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE T_chemin_d_attaque_strategique.id_projet = $getid_projet";
=======
$querylegende = "SELECT DISTINCT 
T_chemin_d_attaque_strategique.id_risque, 
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique 
FROM S_scenario_strategique, T_chemin_d_attaque_strategique, UA_ER
WHERE T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique 
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = UA_ER.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet
ORDER BY T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique ASC";
>>>>>>> origin/Carlos

$resultlegende = mysqli_query($connect, $querylegende);
?>