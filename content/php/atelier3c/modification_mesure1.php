<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {
    $nom_mesure_securite = mysqli_real_escape_string($connect, $input['nom_mesure_securite']);
    $description_mesure_securite = mysqli_real_escape_string($connect, $input['description_mesure_securite']);
    $id_mesure = mysqli_real_escape_string($connect, $input['id_mesure']);

    $results["error"] = false;
    $results["message"] = [];

    // Verification du nom_mesure_securite
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{1,100}$/", $nom_mesure_securite)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Nom mesure sécurité invalide";
    }
    // Verification du description_mesure_securite
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{1,100}$/", $description_mesure_securite)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Description mesure sécurité invalide";
    }

    if ($results["error"] === false) {
        $query = 
        "UPDATE Y_mesure 
        SET 
        nom_mesure = '$nom_mesure_securite',
        description_mesure = '$description_mesure_securite'
        WHERE id_mesure = $id_mesure
        AND id_projet = $getid_projet";

        mysqli_query($connect, $query);  
        $_SESSION['message_success'] = "La mesure de sécurité a bien été modifiée !";
    }
}

if ($input["action"] === 'delete') {
    $query = 
    "DELETE FROM ZB_comporter_2 
    WHERE id_mesure = $id_mesure";
    $query2 = 
    "DELETE FROM Y_mesure 
    WHERE id_mesure = $id_mesure";
    mysqli_query($connect, $query2);

    $_SESSION['message_success'] = "La mesure de sécurité a bien été supprimée !";
}


echo json_encode($input);
