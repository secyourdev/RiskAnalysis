<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

$query_pacs = "SELECT * FROM ZA_traitement_de_securite
NATURAL JOIN ZB_comporter_2
INNER JOIN Y_mesure ON Y_mesure.id_mesure = ZA_traitement_de_securite.id_mesure
INNER JOIN T_chemin_d_attaque_strategique ON ZB_comporter_2.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
WHERE ZA_traitement_de_securite.id_projet = $getid_projet
";

$result_pacs = mysqli_query($connect, $query_pacs);

$query = "SELECT J_valeur_metier.nom_valeur_metier,
M_evenement_redoute.nom_evenement_redoute,
M_evenement_redoute.impact,
M_evenement_redoute.niveau_de_gravite,
P_SROV.description_source_de_risque,
P_SROV.objectif_vise,
P_SROV.pertinence,
T_chemin_d_attaque_strategique.id_risque,
T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
T_chemin_d_attaque_strategique.dependance_residuelle,
T_chemin_d_attaque_strategique.penetration_residuelle,
T_chemin_d_attaque_strategique.maturite_residuelle,
T_chemin_d_attaque_strategique.confiance_residuelle,
T_chemin_d_attaque_strategique.niveau_de_menace_residuelle,
R_partie_prenante.nom_partie_prenante,
R_partie_prenante.niveau_de_menace_partie_prenante,
U_scenario_operationnel.description_scenario_operationnel,
U_scenario_operationnel.vraisemblance,
Y_mesure.nom_mesure,
Y_mesure.description_mesure,
Y_mesure.id_mesure
FROM Y_mesure
NATURAL JOIN ZB_comporter_2
NATURAL JOIN T_chemin_d_attaque_strategique
INNER JOIN S_scenario_strategique ON T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique
INNER JOIN R_partie_prenante ON T_chemin_d_attaque_strategique.id_partie_prenante = R_partie_prenante.id_partie_prenante
INNER JOIN P_SROV ON S_scenario_strategique.id_source_de_risque = P_SROV.id_source_de_risque
INNER JOIN M_evenement_redoute ON S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
INNER JOIN J_valeur_metier ON M_evenement_redoute.id_valeur_metier = J_valeur_metier.id_valeur_metier
INNER JOIN U_scenario_operationnel ON U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
WHERE R_partie_prenante.id_projet = $getid_projet
";

$querychemin = "SELECT * FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);
$resultchemin = mysqli_query($connect, $querychemin);
$query_referentiel = "SELECT * FROM N_socle_de_securite WHERE id_projet = $getid_projet";
$result_referentiel = mysqli_query($connect, $query_referentiel);
$resultlegende = mysqli_query($connect, $querychemin);
?>