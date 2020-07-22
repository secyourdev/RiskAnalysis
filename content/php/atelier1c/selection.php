<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");
$query = "SELECT * FROM M_evenement_redoute INNER JOIN J_valeur_metier on M_evenement_redoute.id_valeur_metier = J_valeur_metier.id_valeur_metier WHERE M_evenement_redoute.id_projet = $getid_projet";
$queryvm = "SELECT id_valeur_metier, nom_valeur_metier FROM J_valeur_metier WHERE id_projet = $getid_projet";
$queryniveaugravite = "SELECT valeur_max_gravite FROM F_projet WHERE id_projet = $getid_projet";
$query1 = "SELECT * FROM D_echelle";
$query2 = "SELECT * FROM E_niveau NATURAL JOIN D_echelle";
$queryechelle = "SELECT id_echelle,nom_echelle FROM D_echelle";
// $queryprojet = "SELECT nom_echelle FROM F_projet NATURAL JOIN D_echelle WHERE id_projet = $getid_projet";

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
$resultniveaugravite = mysqli_query($connect, $queryniveaugravite);


// $resultprojet = mysqli_query($connect, $queryprojet);
?>