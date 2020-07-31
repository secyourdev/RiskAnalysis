<?php
include("../bdd/connexion_sqli.php");
session_start();
$getid_projet = $_SESSION['id_projet'];

$input = filter_input_array(INPUT_POST);

$id_regle_affichage = mysqli_real_escape_string($connect, $input['id_regle_affichage']);
$titre = mysqli_real_escape_string($connect, $input['titre']);
$description = mysqli_real_escape_string($connect, $input['description']);
$etat_de_la_regle = mysqli_real_escape_string($connect, $input['etat_de_la_regle']);
$justification_ecart = mysqli_real_escape_string($connect, $input['justification_ecart']);
$responsable = mysqli_real_escape_string($connect, $input['responsable']);
$dates = mysqli_real_escape_string($connect, $input['dates']);
$id_regle = $input['id_regle'];

$results["error"] = false;
$results["message"] = [];

if ($input["action"] === 'edit') {

    // Verification du id_regle_affichage
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $id_regle_affichage)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "ID règle invalide";
    }
    // Verification du titre
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $titre)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Titre invalide";
    }
    // Verification du description
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $description)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Description invalide";
    }
    // Verification du justification_ecart
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $justification_ecart)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Justification écart invalide";
    }
    // Verification du responsable
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $responsable)) {
        $results["error"] = true;
        $results["message"]["responsable"] = "Responsable invalide";
    }
    // Verification du dates
    if (!preg_match("/^[0-9\s-]{0,100}$/", $dates)) {
        $results["error"] = true;
        $results["message"]["dates"] = "Date invalide";
    }

    if ($results["error"] === false) {
        $query_regle =
            "UPDATE O_regle 
            SET
            id_regle_affichage = '$id_regle_affichage',
            titre = '$titre',
            description = '$description',
            etat_de_la_regle = '$etat_de_la_regle',
            justification_ecart = '$justification_ecart',
            dates = '$dates',
            responsable = '$responsable'
            WHERE id_regle = $id_regle
            AND id_atelier = '1.d'
            AND id_projet = $getid_projet";

            print $query_regle;

        mysqli_query($connect, $query_regle);
        $_SESSION['message_success_2'] = "La règle a bien été modifiée !";
    }
}
if ($input["action"] === 'delete') {
    $query =
        "DELETE FROM O_regle 
        WHERE id_regle = $id_regle
        AND id_atelier = '1.d'
        AND id_projet = $getid_projet";
    mysqli_query($connect, $query);
    $_SESSION['message_success_2'] = "La règle a bien été supprimée !";
}


echo json_encode($input);
