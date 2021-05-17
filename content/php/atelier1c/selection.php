<?php
// $getid_projet = intval($_GET['id_projet']);

$getid_projet = $_SESSION['id_projet'];
include("content/php/bdd/connexion_sqli.php");

$query = "SELECT * FROM M_evenement_redoute INNER JOIN J_valeur_metier on M_evenement_redoute.id_valeur_metier = J_valeur_metier.id_valeur_metier WHERE M_evenement_redoute.id_projet = $getid_projet";
$queryvm = "SELECT id_valeur_metier, nom_valeur_metier FROM J_valeur_metier WHERE id_projet = $getid_projet";

$query1 = "SELECT * FROM DA_echelle NATURAL JOIN DA_evaluer WHERE DA_evaluer.id_projet=$getid_projet EXCEPT SELECT * FROM DA_echelle NATURAL JOIN DA_evaluer WHERE DA_evaluer.id_projet=$getid_projet AND DA_evaluer.id_echelle=1";
$query2 = "SELECT * FROM DA_niveau NATURAL JOIN DA_echelle NATURAL JOIN DA_evaluer WHERE DA_evaluer.id_projet=$getid_projet";
$queryechelle = "SELECT id_echelle,nom_echelle FROM DA_echelle NATURAL JOIN DA_evaluer WHERE DA_evaluer.id_projet=$getid_projet";

if(isset($_POST['nomechelle'])){
    $nom_echelle = $_POST['nomechelle'];
    $affiche_niveau = $connect->prepare("SELECT id_echelle WHERE nom_echelle = ?");
    $affiche_niveau->bind_param("s", $nom_echelle);
    $affiche_niveau->execute();
}

$result1 = mysqli_query($connect, $query1);
$result2 = mysqli_query($connect, $query2);
$resultechelle = mysqli_query($connect, $queryechelle);
$resultechelle2 = mysqli_query($connect, $queryechelle);

$result = mysqli_query($connect, $query);
$resultvm = mysqli_query($connect, $queryvm);

//Requêtes relatives à la génération du rapport

$rq_echelle ="SELECT nom_echelle AS 'Nom de l''échelle' , echelle_gravite AS 'Échelle de gravité' FROM DA_echelle";
$rq_echelle_tab = mysqli_query($connect, $rq_echelle);

$rq_niveau = "SELECT valeur_niveau AS 'Valeur du niveau', description_niveau AS 'Description du niveau' FROM DA_niveau";
$rq_niveau_tab = mysqli_query($connect, $rq_niveau);


?>
