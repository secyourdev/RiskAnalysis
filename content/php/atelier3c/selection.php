<?php
// $getid_projet = intval($_GET['id_projet']);

$getid_projet = $_SESSION['id_projet'];
include("content/php/bdd/connexion_sqli.php");

//affichage tableau partie prenante

$query_partie_prenante = "SELECT * FROM R_partie_prenante WHERE id_projet = $getid_projet";
$result_partie_prenante = mysqli_query($connect, $query_partie_prenante);
$result_partie_prenante2 = mysqli_query($connect, $query_partie_prenante);
$result_partie_prenante3 = mysqli_query($connect, $query_partie_prenante);

$query_categorie_partie_prenante = "SELECT categorie_partie_prenante FROM R_partie_prenante";
$result_categorie_partie_prenante = mysqli_query($connect, $query_categorie_partie_prenante);

//affichage tableau scenario
$query_chemin_d_attaque = "SELECT * FROM chemin_d_attaque_strategique ORDER BY id_chemin_d_attaque_strategique ASC";
$result_chemin_d_attaque = mysqli_query($connect, $query_chemin_d_attaque);

//tableau scénario stratégique
$query_scenario_strategique =
"SELECT
id_scenario_strategique,
nom_scenario_strategique,
id_source_de_risque,
id_evenement_redoute,
nom_evenement_redoute,
niveau_de_gravite,
P_SROV.description_source_de_risque,
objectif_vise
FROM S_scenario_strategique, M_evenement_redoute, P_SROV
WHERE S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
AND S_scenario_strategique.id_source_de_risque = P_SROV.id_source_de_risque
AND S_scenario_strategique.id_projet = $getid_projet
ORDER BY id_scenario_strategique ASC";
$result_scenario_strategique = mysqli_query($connect, $query_scenario_strategique);


$query_mesure1 = "SELECT
Y_mesure.id_mesure,
nom_partie_prenante,
T_chemin_d_attaque_strategique.id_risque,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
Y_mesure.nom_mesure,
Y_mesure.description_mesure
FROM T_chemin_d_attaque_strategique
INNER JOIN ZB_comporter_2
ON T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
INNER JOIN Y_mesure
ON Y_mesure.id_mesure = ZB_comporter_2.id_mesure
INNER JOIN R_partie_prenante
ON T_chemin_d_attaque_strategique.id_partie_prenante = R_partie_prenante.id_partie_prenante
WHERE T_chemin_d_attaque_strategique.id_projet = $getid_projet";

$query_mesure2 = "SELECT DISTINCT
R_partie_prenante.id_partie_prenante,
nom_partie_prenante,
dependance_partie_prenante,
penetration_partie_prenante,
maturite_partie_prenante,
confiance_partie_prenante,
niveau_de_menace_partie_prenante,
dependance_residuelle,
penetration_residuelle,
maturite_residuelle,
confiance_residuelle,
niveau_de_menace_residuelle
FROM T_chemin_d_attaque_strategique
INNER JOIN ZB_comporter_2
ON T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
INNER JOIN Y_mesure
ON Y_mesure.id_mesure = ZB_comporter_2.id_mesure
INNER JOIN R_partie_prenante
ON T_chemin_d_attaque_strategique.id_partie_prenante = R_partie_prenante.id_partie_prenante
WHERE T_chemin_d_attaque_strategique.id_projet = $getid_projet";


$result_mesure1 = mysqli_query($connect, $query_mesure1);
$result_mesure2 = mysqli_query($connect, $query_mesure2);



$query_referentiel = "SELECT * FROM N_socle_de_securite WHERE id_projet = $getid_projet";
$result_referentiel = mysqli_query($connect, $query_referentiel);

$rq_partie2 = "SELECT categorie_partie_prenante AS 'Catégorie', nom_partie_prenante AS 'Partie prenante', type AS 'Type', dependance_partie_prenante AS 'Dépendance', penetration_partie_prenante AS 'Pénétration', maturite_partie_prenante AS 'Maturité', confiance_partie_prenante AS 'Confiance', niveau_de_menace_partie_prenante AS 'Niveau de menace', criticite AS 'Criticité' FROM R_partie_prenante WHERE id_projet = $getid_projet";
$rq_partie2_tab = mysqli_query($connect, $rq_partie2);

$rq_scenar_strat = "SELECT nom_scenario_strategique AS 'Scénario stratégique', CONCAT(description_source_de_risque,': ',objectif_vise) AS 'Source de risque: Objectif visé', nom_evenement_redoute AS 'Événement redouté' FROM S_scenario_strategique NATURAL JOIN P_SROV NATURAL JOIN M_evenement_redoute WHERE id_projet =$getid_projet AND id_atelier = '3.c'";
$rq_scenar_strat_tab = mysqli_query($connect, $rq_scenar_strat);
