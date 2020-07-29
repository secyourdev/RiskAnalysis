<?php
session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {

    $results["error"] = false;
    $results["message"] = [];

    $nom_scenario_strategique = mysqli_real_escape_string($connect, $input['nom_scenario_strategique']);

    // Verification du nom_scenario_strategique
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{1,100}$/", $nom_scenario_strategique)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Nom scénario stratégique invalide";
    }


    if ($results["error"] === false) {
        $query = "
        UPDATE S_scenario_strategique 
        SET 
        nom_scenario_strategique = '" . $nom_scenario_strategique . "'
        WHERE id_scenario_strategique = '" . $input["id_scenario_strategique"] . "'
        ";

        mysqli_query($connect, $query);
        $_SESSION['message_success'] = "Le scénario stratégique a bien été modifié !";
    }
}

if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM S_scenario_strategique 
    WHERE id_scenario_strategique = '".$input["id_scenario_strategique"]."'
    ";
    mysqli_query($connect, $query);
    $_SESSION['message_success'] = "Le scénario stratégique a bien été supprimé !";
}


echo json_encode($input);
