<?php
session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {
    $nomscenar = mysqli_real_escape_string($connect, $input['scenario_operationnel']);
    $modeope = mysqli_real_escape_string($connect, $input['mode_operatoire']);

    $results["error"] = false;

    // Verification du type de l'attaquant
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $modeope)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Mode opératoire invalide";
    }

    if ($results["error"] === false) {
        $query = "
        UPDATE W_mode_operatoire 
        SET mode_operatoire = '".$modeope."'
        WHERE id_mode_operatoire = '".$input["id_mode_operatoire"]."'
        ";
        mysqli_query($connect, $query);
        $_SESSION['message_success_2'] = "Le mode opératoire a été bien modifié !";
    }
}

if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM W_mode_operatoire 
    WHERE id_mode_operatoire = '".$input["id_mode_operatoire"]."'
    ";
    mysqli_query($connect, $query);
    $_SESSION['message_success_2'] = "Le mode opératoire a été bien supprimé !";
}


echo json_encode($input);
