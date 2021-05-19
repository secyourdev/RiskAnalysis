<?php
// $getid_projet = intval($_GET['id_projet']);

$getid_projet = $_SESSION['id_projet'];
include("content/php/bdd/connexion_sqli.php");

//affichage tableau de rappel
$query_evenement_redoutes = "SELECT * FROM M_evenement_redoute INNER JOIN J_valeur_metier on M_evenement_redoute.id_valeur_metier = J_valeur_metier.id_valeur_metier WHERE M_evenement_redoute.id_projet = $getid_projet";
$query_SROV = "SELECT id_source_de_risque, type_d_attaquant_source_de_risque,profil_de_l_attaquant_source_de_risque, description_source_de_risque, objectif_vise, description_objectif_vise FROM P_SROV WHERE id_projet = $getid_projet AND choix_source_de_risque = 'P1' ORDER BY id_source_de_risque";

//affichage tableau modifiable
$query_scenario_strategique =
"SELECT
S_scenario_strategique.id_scenario_strategique,
nom_scenario_strategique,
S_scenario_strategique.id_source_de_risque,
P_SROV.description_source_de_risque,
objectif_vise
FROM S_scenario_strategique, P_SROV
WHERE S_scenario_strategique.id_source_de_risque = P_SROV.id_source_de_risque
AND P_SROV.id_projet = $getid_projet
ORDER BY id_scenario_strategique ASC";

$query_chemin_d_attaque =
"SELECT T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique,
T_chemin_d_attaque_strategique.id_risque,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
T_chemin_d_attaque_strategique.description_chemin_d_attaque_strategique,
T_chemin_d_attaque_strategique.id_scenario_strategique,
S_scenario_strategique.nom_scenario_strategique,
nom_partie_prenante
FROM S_scenario_strategique, T_chemin_d_attaque_strategique, R_partie_prenante
WHERE T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique
AND T_chemin_d_attaque_strategique.id_partie_prenante = R_partie_prenante.id_partie_prenante
AND R_partie_prenante.id_projet = $getid_projet
ORDER BY id_chemin_d_attaque_strategique ASC";



$result_evenement_redoutes = mysqli_query($connect, $query_evenement_redoutes);
$result_SROV = mysqli_query($connect, $query_SROV);

$result_scenario_strategique = mysqli_query($connect, $query_scenario_strategique);
$result_chemin_d_attaque = mysqli_query($connect, $query_chemin_d_attaque);




//modal scenario strat
$query_id_source_de_risque = "SELECT id_source_de_risque, profil_de_l_attaquant_source_de_risque, objectif_vise FROM P_SROV WHERE id_projet = $getid_projet AND choix_source_de_risque = 'P1' ORDER BY id_source_de_risque ASC";
$query_id_evenement_redoute = "SELECT id_evenement_redoute, nom_evenement_redoute FROM M_evenement_redoute WHERE id_projet = $getid_projet ORDER BY id_evenement_redoute ASC";
$query_id_partie_prenante = "SELECT id_partie_prenante, nom_partie_prenante FROM R_partie_prenante WHERE id_projet = $getid_projet ORDER BY id_partie_prenante ASC";

$result_id_source_de_risque = mysqli_query($connect, $query_id_source_de_risque);
$result_id_evenement_redoute = mysqli_query($connect, $query_id_evenement_redoute);
$result_id_partie_prenante = mysqli_query($connect, $query_id_partie_prenante);


//modal chemin strat
$query_id_scenario_strategique = "SELECT id_scenario_strategique, nom_scenario_strategique FROM S_scenario_strategique WHERE id_projet = $getid_projet ORDER BY id_scenario_strategique ASC";

$result_id_scenario_strategique = mysqli_query($connect, $query_id_scenario_strategique);







// browse image
$query = "SELECT * FROM S_scenario_strategique WHERE id_projet = $getid_projet";
$result = mysqli_query($connect, $query);
$query_scenario_op = "SELECT id_scenario_strategique, nom_scenario_strategique FROM S_scenario_strategique WHERE id_projet = $getid_projet AND id_atelier = '3.b'";
$result_scenario_op = mysqli_query($connect, $query_scenario_op);

//Requêtes relatives à la génération de Rapport

$rq_cidt = "SELECT nom_valeur_metier AS 'Valeur métier', nom_evenement_redoute AS 'Nom de l''événement redouté', description_evenement_redoute AS 'Description de l''événement redouté', impact AS 'Impacts', confidentialite AS 'C', integrite AS 'I',disponibilite AS 'D', tracabilite AS 'T', niveau_de_gravite AS 'Gravité' FROM M_evenement_redoute INNER JOIN J_valeur_metier on M_evenement_redoute.id_valeur_metier = J_valeur_metier.id_valeur_metier WHERE M_evenement_redoute.id_projet = $getid_projet";
$rq_cidt_tab = mysqli_query($connect, $rq_cidt);

$rq_srov4 = "SELECT type_d_attaquant_source_de_risque AS 'Type d''attaquant', profil_de_l_attaquant_source_de_risque AS 'Profile de l''attaquant', description_source_de_risque AS 'Description source de risque', objectif_vise AS 'Objectifs visés', description_objectif_vise AS 'Description de l''objectif' FROM P_SROV WHERE id_projet = $getid_projet AND choix_source_de_risque = 'P1'";
$rq_srov4_tab = mysqli_query($connect, $rq_srov4);
