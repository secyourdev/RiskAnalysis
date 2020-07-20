<?php
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$chemin_d_attaque_strategique = mysqli_real_escape_string($connect, $input['chemin_d_attaque_strategique']);
$nom_scenario_strategique = mysqli_real_escape_string($connect, $input['nom_scenario_strategique']);

$results["error"] = false;
$results["message"] = [];


if ($input["action"] === 'edit' && $results["error"] === false) {
    $query = "
    UPDATE chemin_d_attaque_strategique 
    SET 
    nom_chemin_d_attaque_strategique = '" . $chemin_d_attaque_strategique . "'
    WHERE id_chemin_d_attaque_strategique = '" . $input["id_chemin_d_attaque_strategique"] . "'
    ";
    echo $query;

    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM chemin_d_attaque_strategique 
    WHERE id_chemin_d_attaque_strategique = '" . $input["id_chemin_d_attaque_strategique"] . "'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
