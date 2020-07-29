<?php
session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit'){
    $dependance_residuelle = mysqli_real_escape_string($connect, $input['dependance_residuelle']);
    $penetration_residuelle = mysqli_real_escape_string($connect, $input['penetration_residuelle']);
    $maturite_residuelle = mysqli_real_escape_string($connect, $input['maturite_residuelle']);
    $confiance_residuelle = mysqli_real_escape_string($connect, $input['confiance_residuelle']);
    $id_partie_prenante = mysqli_real_escape_string($connect, $input['id_partie_prenante']);

    $results["error"] = false;
    $results["message"] = [];


    // Verification du dependance_residuelle
    if (!preg_match("/^[1-4]$/", $dependance_residuelle)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Dépendance résiduelle invalide";
    }
    // Verification du penetration_residuelle
    if (!preg_match("/^[1-4]$/", $penetration_residuelle)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Pénétration résiduelle invalide";
    }
    // Verification du maturite_residuelle
    if (!preg_match("/^[1-4]$/", $maturite_residuelle)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Maturité résiduelle invalide";
    }
    // Verification du confiance_residuelle
    if (!preg_match("/^[1-4]$/", $confiance_residuelle)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Confiance résiduelle invalide";
    }

    if ($results["error"] === false){
        // recupere les valeurs de ponderation
        $recupere_ponderation = "SELECT ponderation_dependance, ponderation_penetration, ponderation_maturite, ponderation_confiance FROM R_partie_prenante WHERE id_partie_prenante = $id_partie_prenante";
        $result_ponderation = mysqli_query($connect, $recupere_ponderation);
        $row = mysqli_fetch_array($result_ponderation);
        $ponderation_dependance = $row["ponderation_dependance"];
        $ponderation_penetration = $row["ponderation_penetration"];
        $ponderation_maturite = $row["ponderation_maturite"];
        $ponderation_confiance = $row["ponderation_confiance"];
        
        $menace_residuelle = round(($dependance_residuelle*$ponderation_dependance * $penetration_residuelle*$ponderation_penetration) / ($maturite_residuelle*$ponderation_maturite * $confiance_residuelle*$ponderation_confiance), 2);
        
        //update les valeurs résiduelles du chemin
        $updatechemin = 
        "UPDATE R_partie_prenante
        SET dependance_residuelle = $dependance_residuelle,
        penetration_residuelle = $penetration_residuelle,
        maturite_residuelle = $maturite_residuelle,
        confiance_residuelle = $confiance_residuelle,
        niveau_de_menace_residuelle = $menace_residuelle
        WHERE id_partie_prenante = $id_partie_prenante" ;
        mysqli_query($connect, $updatechemin);
        
        $_SESSION['message_success_2'] = "L'évaluation de la menace en fonction des mesures appliquées a bien été ajoutée !";
    }
}

echo json_encode($input);
