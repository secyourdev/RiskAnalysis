<?php
// $getid_projet = intval($_GET['id_projet']);


$getid_projet = $_SESSION['id_projet'];
include("content/php/bdd/connexion_sqli.php");

$query3 = "SELECT
U_scenario_operationnel.id_scenario_operationnel,
T_chemin_d_attaque_strategique.id_risque,
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique,
U_scenario_operationnel.description_scenario_operationnel,
U_scenario_operationnel.vraisemblance
FROM U_scenario_operationnel,T_chemin_d_attaque_strategique
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND U_scenario_operationnel.id_projet = $getid_projet
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet";

$queryprojet = "SELECT echelle_vraisemblance FROM F_projet NATURAL JOIN DA_echelle WHERE F_projet.id_projet = $getid_projet";

$result3 = mysqli_query($connect, $query3);
$resultprojet = mysqli_query($connect, $queryprojet);


$query = "SELECT * FROM M_evenement_redoute INNER JOIN J_valeur_metier on M_evenement_redoute.id_valeur_metier = J_valeur_metier.id_valeur_metier WHERE M_evenement_redoute.id_projet = $getid_projet";
$queryvm = "SELECT id_valeur_metier, nom_valeur_metier FROM J_valeur_metier WHERE id_projet = $getid_projet";

$query1 = "SELECT * FROM DC_echelle_vraisemblance WHERE id_projet=$getid_projet";
//$query2 = "SELECT * FROM DA_niveau NATURAL JOIN DA_echelle NATURAL JOIN DA_evaluer WHERE DA_evaluer.id_projet=$getid_projet";
$queryechelle = "SELECT id_echelle,nom_echelle FROM DC_echelle_vraisemblance WHERE id_projet=$getid_projet";

/*f(isset($_POST['nomechelle'])){
    $nom_echelle = $_POST['nomechelle'];
    $affiche_niveau = $connect->prepare("SELECT id_echelle WHERE nom_echelle = ?");
    $affiche_niveau->bind_param("s", $nom_echelle);
    $affiche_niveau->execute();
}*/

$result1 = mysqli_query($connect, $query1);
//$result2 = mysqli_query($connect, $query2);
$resultechelle = mysqli_query($connect, $queryechelle);
$resultechelle2 = mysqli_query($connect, $queryechelle);

$result = mysqli_query($connect, $query);
$resultvm = mysqli_query($connect, $queryvm);

//Requêtes relatives à la génération du RA Rapport

$rq_eval_vrai = "SELECT
T_chemin_d_attaque_strategique.id_risque AS 'Numéro du risque',
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique AS 'Chemin d''attaque stratégique',
U_scenario_operationnel.description_scenario_operationnel AS 'Scénario opérationnel',
U_scenario_operationnel.vraisemblance AS 'Vraisemblance'
FROM U_scenario_operationnel,T_chemin_d_attaque_strategique
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND U_scenario_operationnel.id_projet = $getid_projet
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet";

$rq_eval_vrai_tab = mysqli_query($connect, $rq_eval_vrai);




?>
