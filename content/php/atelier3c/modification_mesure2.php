<?php
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit'){
    $dependance_residuelle = $_POST['dependance_residuelle'];
    $penetration_residuelle = $_POST['penetration_residuelle'];
    $maturite_residuelle = $_POST['maturite_residuelle'];
    $confiance_residuelle = $_POST['confiance_residuelle'];
    $id_partie_prenante = $_POST['id_partie_prenante'];

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
        $update = $bdd->prepare("SELECT `ponderation_dependance`, `ponderation_penetration`, `ponderation_maturite`, `ponderation_confiance` FROM `R_partie_prenante` WHERE `id_partie_prenante`=?");
        $update->bindParam(1, $id_partie_prenante);
        $update->execute();
        $row = $update->fetch();
        $ponderation_dependance = $row['ponderation_dependance'];
        $ponderation_penetration = $row['ponderation_penetration'];
        $ponderation_maturite = $row['ponderation_maturite'];
        $ponderation_confiance = $row['ponderation_confiance'];
        
        $menace_residuelle = round(($dependance_residuelle*$ponderation_dependance * $penetration_residuelle*$ponderation_penetration) / ($maturite_residuelle*$ponderation_maturite * $confiance_residuelle*$ponderation_confiance), 2);
        
        //update les valeurs résiduelles du chemin      
        $update = $bdd->prepare("UPDATE `R_partie_prenante` SET `dependance_residuelle`=?, `penetration_residuelle`=?, `maturite_residuelle`=?, `confiance_residuelle`=?, `niveau_de_menace_residuelle`=?  WHERE `id_partie_prenante`=?");
        $update->bindParam(1, $dependance_residuelle);
        $update->bindParam(2, $penetration_residuelle);
        $update->bindParam(3, $maturite_residuelle);
        $update->bindParam(4, $confiance_residuelle);
        $update->bindParam(5, $menace_residuelle);
        $update->bindParam(6, $id_partie_prenante);
        $update->execute();

        $_SESSION['message_success_2'] = "L'évaluation de la menace en fonction des mesures appliquées a bien été ajoutée !";

    }
}

echo json_encode($input);
