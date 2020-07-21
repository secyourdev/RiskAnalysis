<?php
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$choix_sr = mysqli_real_escape_string($connect, $input['choix_source_de_risque']);

$results["error"] = false;

if ($input["action"] === 'edit' && $results["error"] === false) {

    $query = "
    UPDATE P_SROV 
    SET choix_source_de_risque = '".$choix_sr."'
    WHERE id_source_de_risque = '".$input["id_source_de_risque"]."'
    ";
    echo $query;
    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM P_SROV 
    WHERE id_source_de_risque = '".$input["id_source_de_risque"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);
