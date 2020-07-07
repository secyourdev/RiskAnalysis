<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v14");
$query = "SELECT * FROM evenement_redoute INNER JOIN valeur_metier on evenement_redoute.id_valeur_metier = valeur_metier.id_valeur_metier";
//$querynomvaleurmetier = "SELECT nom_valeur_metier FROM evenement_redoutes INNER JOIN valeur_metier on evenement_redoutes.id_valeur_metier = valeur_metier.id_valeur_metier";
$queryvm = "SELECT nom_valeur_metier FROM valeur_metier";
$queryniveaugravite = "SELECT valeur_max_gravite FROM projet";
$query1 = "SELECT * FROM echelle";
$query2 = "SELECT * FROM niveau NATURAL JOIN echelle";
$queryechelle = "SELECT nom_echelle FROM echelle";
$queryprojet = "SELECT nom_echelle FROM projet NATURAL JOIN echelle WHERE id_projet = 1";

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
$resultprojet = mysqli_query($connect, $queryprojet);
?>