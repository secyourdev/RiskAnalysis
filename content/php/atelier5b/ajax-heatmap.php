<?php

session_start();
$getid_projet = $_SESSION['id_projet'];
include("../bdd/connexion.php");

$results["error"] = false;

$case_echelle_gravite = $_POST['case_echelle_gravite']; //1
$case_echelle_vraisemblance = $_POST['case_echelle_vraisemblance']; //5
$case_couleur = $_POST['case_couleur']; //rouge


$exist_bareme = $bdd->prepare("SELECT id_bareme_risque, vraisemblance, gravite, bareme, id_projet 
FROM DB_bareme_risque 
WHERE vraisemblance = ?
AND gravite = ? 
AND id_projet = $getid_projet");

$insere_bareme = $bdd->prepare(
    "INSERT INTO DB_bareme_risque(id_bareme_risque, vraisemblance, gravite, bareme, id_projet) VALUES ('',?,?,?,$getid_projet)"
);

$update_bareme = $bdd->prepare(
    "UPDATE DB_bareme_risque SET bareme=? WHERE id_bareme_risque=? AND id_projet=$getid_projet"
);


if ($results["error"] === false) {
    $exist_bareme->bindParam(1, $case_echelle_vraisemblance);
    $exist_bareme->bindParam(2, $case_echelle_gravite);
    $exist_bareme->execute();
    $result_exist_bareme = $exist_bareme->fetch();

    if ($result_exist_bareme == false) {
        $insere_bareme->bindParam(1, $case_echelle_vraisemblance);
        $insere_bareme->bindParam(2, $case_echelle_gravite);
        $insere_bareme->bindParam(3, $case_couleur);
        $insere_bareme->execute();
        $_SESSION['message_success_2'] = "Le barème a bien été ajouté !";
    } else {
        $update_bareme->bindParam(1, $case_couleur);
        $update_bareme->bindParam(2, $result_exist_bareme["id_bareme_risque"]);
        $update_bareme->execute();
    }
}
