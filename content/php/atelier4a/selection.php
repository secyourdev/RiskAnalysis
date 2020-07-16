<?php
$getid_projet = intval($_GET['id_projet']);
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");
$query1 = "SELECT scenario_strategique.id_scenario_strategique, nom_scenario_strategique, description_source_de_risque, objectif_vise, nom_evenement_redoute, id_risque, nom_chemin_d_attaque_strategique, niveau_de_gravite FROM scenario_strategique 
INNER JOIN SROV ON scenario_strategique.id_source_de_risque = SROV.id_source_de_risque 
INNER JOIN evenement_redoute ON scenario_strategique.id_evenement_redoute = evenement_redoute.id_evenement_redoute
INNER JOIN chemin_d_attaque_strategique On scenario_strategique.id_scenario_strategique = chemin_d_attaque_strategique.id_scenario_strategique
INNER JOIN partie_prenante ON chemin_d_attaque_strategique.id_partie_prenante = partie_prenante.id_partie_prenante
WHERE scenario_strategique.id_projet = $getid_projet 
";

$query2 = "SELECT * FROM chemin_d_attaque_strategique NATURAL JOIN scenario_operationnel WHERE id_projet = $getid_projet";
$query3 = "SELECT * FROM scenario_operationnel";
$query4 = "SELECT * FROM mode_operatoire INNER JOIN scenario_operationnel
ON mode_operatoire.id_scenario_operationnel = scenario_operationnel.id_scenario_operationnel";
$queryprojet = "SELECT echelle_vraisemblance FROM projet NATURAL JOIN echelle WHERE id_projet = $getid_projet";

$result1 = mysqli_query($connect, $query1);
$result2 = mysqli_query($connect, $query2);
$result3 = mysqli_query($connect, $query3);
$result4 = mysqli_query($connect, $query4);
$resultprojet = mysqli_query($connect, $queryprojet);
?>
