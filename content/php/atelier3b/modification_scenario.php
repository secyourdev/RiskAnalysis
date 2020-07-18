<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");

$input = filter_input_array(INPUT_POST);


$nom_scenario_strategique = mysqli_real_escape_string($connect, $input['nom_scenario_strategique']);

$results["error"] = false;
$results["message"] = [];

if ($input["action"] === 'edit' && $results["error"] === false) {
    $query = "
    UPDATE scenario_strategique 
    SET 
    nom_scenario_strategique = '" . $nom_scenario_strategique . "'
    WHERE id_scenario_strategique = '" . $input["id_scenario_strategique"] . "'
    ";
    echo $query;

    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM scenario_strategique 
    WHERE id_scenario_strategique = '".$input["id_scenario_strategique"]."'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
