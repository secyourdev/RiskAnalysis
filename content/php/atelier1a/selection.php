<?php
include("content/php/bdd/connexion_sqli.php");
$getid_projet = $_SESSION['id_projet'];

$query = "SELECT DISTINCT id_utilisateur,nom,prenom,poste FROM `H_RACI` NATURAL JOIN A_utilisateur WHERE id_projet =$getid_projet ORDER BY id_utilisateur ASC";
$acteur_choisi = mysqli_query($connect, $query);


$query2 = "SELECT DISTINCT id_utilisateur FROM `H_RACI` NATURAL JOIN A_utilisateur WHERE id_projet =$getid_projet ORDER BY id_utilisateur ASC";
$RACI_id_user = mysqli_query($connect, $query2);

$query3 = "SELECT DISTINCT nom,prenom FROM `H_RACI` NATURAL JOIN A_utilisateur WHERE id_projet =$getid_projet ORDER BY id_utilisateur ASC";
$RACI_user = mysqli_query($connect, $query3);

$query_grp_user = "SELECT nom_grp_utilisateur FROM B_grp_utilisateur";
$result_grp_user = mysqli_query($connect, $query_grp_user);

$recupere_id_grp_utilisateur = "SELECT id_grp_utilisateur FROM F_projet WHERE id_projet =$getid_projet";
$result_id_grp_utilisateur = mysqli_query($connect, $recupere_id_grp_utilisateur);
$result_fetch = mysqli_fetch_array($result_id_grp_utilisateur);
$id_grp_utilisateur = $result_fetch["id_grp_utilisateur"];

$query_RACI_user = "SELECT id_utilisateur,nom,prenom FROM C_impliquer NATURAL JOIN A_utilisateur WHERE id_grp_utilisateur=$id_grp_utilisateur";
$result_RACI_user  = mysqli_query($connect, $query_RACI_user);
$query_resp_risque_residuel= "SELECT DISTINCT id_utilisateur,nom,prenom FROM `H_RACI` NATURAL JOIN A_utilisateur WHERE id_projet =$getid_projet ORDER BY id_utilisateur ASC";
$result_risques_residuels  = mysqli_query($connect, $query_resp_risque_residuel);

//Requêtes relatives à la génération de rapport

$rq_acteurs = "SELECT DISTINCT nom AS 'Nom',prenom AS 'Prénom',poste AS 'Poste' FROM `H_RACI` NATURAL JOIN A_utilisateur WHERE id_projet =$getid_projet ORDER BY id_utilisateur ASC";
$rq_tab_acteurs = mysqli_query($connect, $rq_acteurs);

$rq_raci = "SELECT DISTINCT nom AS 'Nom', prenom AS 'Prénom', CONCAT(id_atelier,' ',nom_atelier) AS 'Atelier', ecriture AS 'Écriture' FROM H_RACI NATURAL JOIN A_utilisateur NATURAL JOIN G_atelier WHERE id_projet=$getid_projet";
$rq_tab_raci = mysqli_query($connect, $rq_raci);

//*************************1.a Données Principales////////////////////////////
$rq_donnees_principales = "SELECT *,num_version FROM F_projet NATURAL JOIN ZC_version WHERE id_projet = $getid_projet";
$rq_donnees_principales_res = mysqli_query($connect, $rq_donnees_principales);

$rq_respo = "SELECT A_utilisateur.nom,A_utilisateur.prenom FROM A_utilisateur NATURAL JOIN F_projet WHERE A_utilisateur.id_utilisateur = F_projet.responsable_risque_residuel AND id_projet = $getid_projet";
$rq_respo_res = mysqli_query($connect, $rq_respo);



?>
