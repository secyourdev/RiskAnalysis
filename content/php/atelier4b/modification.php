<?php
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
    echo $query;
    mysqli_query($connect, $query);
}


echo json_encode($input);
