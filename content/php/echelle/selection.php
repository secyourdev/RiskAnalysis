<?php
include("content/php/bdd/connexion_sqli.php");

$query1 = "SELECT * FROM D_echelle";
$query2 = "SELECT * FROM E_niveau NATURAL JOIN D_echelle";
$queryechelle = "SELECT nom_echelle FROM D_echelle";
$queryechelle2 = "SELECT nom_echelle FROM D_echelle";

if(isset($_POST['nomechelle'])){
    $nom_echelle = $_POST['nomechelle'];
    $affiche_niveau = $connect->prepare("SELECT id_echelle WHERE nom_echelle = ?");
    $affiche_niveau->bind_param("s", $nom_echelle);
    $affiche_niveau->execute();
}

$result1 = mysqli_query($connect, $query1);
$result2 = mysqli_query($connect, $query2);
$resultechelle = mysqli_query($connect, $queryechelle);
$resultechelle2 = mysqli_query($connect, $queryechelle2);

?>