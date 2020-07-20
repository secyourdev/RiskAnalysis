<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");
$query = "SELECT valeur_metier.nom_valeur_metier,
evenement_redoute.nom_evenement_redoute,
evenement_redoute.impact,
evenement_redoute.niveau_de_gravite,
SROV.description_source_de_risque,
SROV.objectif_vise,
SROV.pertinence,
chemin_d_attaque_strategique.id_risque,
chemin_d_attaque_strategique.id_chemin_d_attaque_strategique,
chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
chemin_d_attaque_strategique.niveau_de_menace_residuelle,
partie_prenante.nom_partie_prenante,
partie_prenante.niveau_de_menace_partie_prenante,
scenario_operationnel.description_scenario_operationnel,
scenario_operationnel.vraisemblance,
mesure.nom_mesure,
mesure.id_mesure
FROM mesure
NATURAL JOIN comporter_2
NATURAL JOIN chemin_d_attaque_strategique
INNER JOIN scenario_strategique ON chemin_d_attaque_strategique.id_scenario_strategique = scenario_strategique.id_scenario_strategique
INNER JOIN partie_prenante ON chemin_d_attaque_strategique.id_partie_prenante = partie_prenante.id_partie_prenante
INNER JOIN SROV ON scenario_strategique.id_source_de_risque = SROV.id_source_de_risque
INNER JOIN evenement_redoute ON scenario_strategique.id_evenement_redoute = evenement_redoute.id_evenement_redoute
INNER JOIN valeur_metier ON evenement_redoute.id_valeur_metier = valeur_metier.id_valeur_metier
INNER JOIN scenario_operationnel ON scenario_operationnel.id_chemin_d_attaque_strategique = chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
WHERE partie_prenante.id_projet = $getid_projet
";

$querychemin = "SELECT * FROM chemin_d_attaque_strategique NATURAL JOIN scenario_strategique WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);
$resultchemin = mysqli_query($connect, $querychemin);
$query_referentiel = "SELECT * FROM socle_de_securite WHERE id_projet = $getid_projet";
$result_referentiel = mysqli_query($connect, $query_referentiel);
?>