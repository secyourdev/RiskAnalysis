<?php
session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$vraisemblance = mysqli_real_escape_string($connect, $input['vraisemblance']);


$results["error"] = false;
$results["message"] = [];


if ($input["action"] === 'edit' && $results["error"] === false) {
    
    $query = "
    UPDATE U_scenario_operationnel 
    SET vraisemblance = '".$vraisemblance."'
    WHERE id_scenario_operationnel = '".$input["id_scenario_operationnel"]."'
    ";
    mysqli_query($connect, $query);
    $_SESSION['message_success'] = "La vraisemblance du scénario opérationnel a été bien modifiée !";
}


echo json_encode($input);
