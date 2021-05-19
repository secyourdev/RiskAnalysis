<?php
include("content/php/bdd/connexion_sqli.php");
$getid_projet = $_SESSION['id_projet'];

$query_pacs = "SELECT * , Y_mesure.id_atelier AS Y_id_atelier
FROM ZA_traitement_de_securite, ZB_comporter_2, Y_mesure, T_chemin_d_attaque_strategique
WHERE ZA_traitement_de_securite.id_mesure = Y_mesure.id_mesure
AND Y_mesure.id_mesure = ZB_comporter_2.id_mesure
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
AND ZA_traitement_de_securite.id_projet = $getid_projet
AND Y_mesure.id_projet = $getid_projet
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet
";

$result_pacs = mysqli_query($connect, $query_pacs);

$querychemin = "SELECT * FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE T_chemin_d_attaque_strategique.id_projet = $getid_projet";
$querylegende = "SELECT DISTINCT id_risque, nom_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique NATURAL JOIN S_scenario_strategique WHERE T_chemin_d_attaque_strategique.id_projet = $getid_projet";

$resultchemin = mysqli_query($connect, $querychemin);
$query_referentiel = "SELECT * FROM N_socle_de_securite WHERE id_projet = $getid_projet";
$result_referentiel = mysqli_query($connect, $query_referentiel);
$resultlegende = mysqli_query($connect, $querylegende);


//requete generation de Rapport
//$rq_plan_amelio = "SELECT nom_mesure AS 'Mesure de sécurité', id_risque AS 'Scénario des risques associés', date_traitement_de_securite AS 'Échéance', description_mesure AS 'Description mesure de sécurité',id_atelier AS 'Atelier', responsable AS 'Responsable', principe_de_securite AS 'Principe de sécurité', difficulte_traitement_de_securite AS 'Frein et difficultés de mise en oeuvre', cout_traitement_de_securite AS 'Cout', statut AS 'Statut' FROM za_traitement_de_securite NATURAL JOIN t_chemin_d_attaque_strategique NATURAL JOIN s_scenario_strategique NATURAL JOIN y_mesure WHERE id_projet = $getid_projet";

$rq_plan_amelio = "SELECT  Y_mesure.nom_mesure AS 'Mesure de sécurité', Y_mesure.description_mesure AS 'Description mesure de sécurité', ZA_traitement_de_securite.id_atelier AS 'Atelier', T_chemin_d_attaque_strategique.id_risque AS 'Scénario des risques associés', ZA_traitement_de_securite.principe_de_securite AS 'Principe de sécurité', ZA_traitement_de_securite.responsable AS 'Responsable', ZA_traitement_de_securite.difficulte_traitement_de_securite AS 'Frein et difficultés de mise en oeuvre', ZA_traitement_de_securite.cout_traitement_de_securite AS 'Cout', ZA_traitement_de_securite.date_traitement_de_securite AS 'Échéance', ZA_traitement_de_securite.statut FROM ZA_traitement_de_securite, ZB_comporter_2, Y_mesure, T_chemin_d_attaque_strategique
WHERE ZA_traitement_de_securite.id_mesure = Y_mesure.id_mesure
AND Y_mesure.id_mesure = ZB_comporter_2.id_mesure
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
AND ZA_traitement_de_securite.id_projet = $getid_projet
AND Y_mesure.id_projet = $getid_projet
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet
";
$rq_plan_amelio_tab = mysqli_query($connect, $rq_plan_amelio);
?>
