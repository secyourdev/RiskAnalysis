<?php

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");

$input = filter_input_array(INPUT_POST);

// $id_risque = mysqli_real_escape_string($connect, $input['id_risque']);
// $chemin_d_attaque_strategique = mysqli_real_escape_string($connect, $input['chemin_d_attaque_strategique']);
$description_scenario_operationnel = mysqli_real_escape_string($connect, $input['description_scenario_operationnel']);

$results["error"] = false;

// Verification du type de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_scenario_operationnel)) {
    $results["error"] = true;
}

if ($input["action"] === 'edit' && $results["error"] === false) {
    
    $query = "
    UPDATE scenario_operationnel 
    SET description_scenario_operationnel = '".$description_scenario_operationnel."'
    WHERE id_scenario_operationnel = '".$input["id_scenario_operationnel"]."'
    ";
    echo $query;
    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM scenario_operationnel 
    WHERE id_scenario_operationnel = '".$input["id_scenario_operationnel"]."'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
