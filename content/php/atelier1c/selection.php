<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");
$query = "SELECT * FROM evenement_redoute INNER JOIN valeur_metier on evenement_redoute.id_valeur_metier = valeur_metier.id_valeur_metier WHERE valeur_metier.id_projet = $getid_projet";
$queryvm = "SELECT nom_valeur_metier FROM valeur_metier WHERE id_projet = $getid_projet";
$queryniveaugravite = "SELECT valeur_max_gravite FROM projet WHERE id_projet = $getid_projet";
$query1 = "SELECT * FROM echelle";
$query2 = "SELECT * FROM niveau NATURAL JOIN echelle";
$queryechelle = "SELECT id_echelle,nom_echelle FROM echelle";
// $queryprojet = "SELECT nom_echelle FROM projet NATURAL JOIN echelle WHERE id_projet = $getid_projet";

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