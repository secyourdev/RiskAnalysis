<?php

session_start();
$getid_projet = $_SESSION['id_projet'];
print $getid_projet;
include("../bdd/connexion.php");

$results["error"] = false;


$case_echelle_gravite = $_POST['case_echelle_gravite_value'];
$case_echelle_vraisemblance = $_POST['case_echelle_vraisemblance_value'];
$case_couleur = $_POST['case_couleur_value'];

$insere_regle = $bdd->prepare(
"INSERT INTO DB_bareme_risque(id_bareme_risque, vraisemblance, gravite, bareme, id_projet) VALUES ('',?,?,?,?)"
);


if ($results["error"] === false ) {

    $insere_regle->bindParam(1, $case_echelle_gravite);
    $insere_regle->bindParam(2, $case_echelle_vraisemblance);
    $insere_regle->bindParam(3, $case_couleur);
    $insere_regle->bindParam(4, $getid_projet);
    $insere_regle->execute();
    $_SESSION['message_success_2'] = "Le barème a bien été ajouté !";
}