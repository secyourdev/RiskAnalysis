<?php
session_start();

include("../bdd/connexion.php");

$update = $bdd->prepare("UPDATE F_projet SET id_echelle = ? WHERE id_projet = ?");
$get_gravite = $bdd->prepare("SELECT echelle_gravite FROM DA_echelle WHERE id_echelle = ?");
$updateer = $bdd->prepare("UPDATE M_evenement_redoute SET niveau_de_gravite = 4 WHERE niveau_de_gravite = 5");
$id_projet = $_SESSION['id_projet'];

if(isset($_POST['id_echelle'])){

    $id_echelle = $_POST['id_echelle'];
    $update->bindParam(1, $id_echelle);
    $update->bindParam(2, $id_projet);
    $update->execute();
    $get_gravite->bindParam(1, $id_echelle[0]);
    $get_gravite->execute();
    $gravite = $get_gravite->fetch();
    if ($gravite[0] === "4"){
        $updateer->execute();
    }
         
}
