<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");

$input = filter_input_array(INPUT_POST);


$nom_mesure_securite = mysqli_real_escape_string($connect, $input['nom_mesure_securite']);
$description_mesure_securite = mysqli_real_escape_string($connect, $input['description_mesure_securite']);

$results["error"] = false;
$results["message"] = [];


if ($input["action"] === 'edit' && $results["error"] === false) {
    $query = "
    UPDATE mesure 
    SET 
    nom_mesure = '" . $nom_mesure_securite . "',
    description_mesure = '" . $description_mesure_securite . "'
    WHERE id_mesure = '" . $input["id_mesure"] . "'
    ";
    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM comporter_2 
    WHERE id_mesure = '".$input["id_mesure"]."'
    ";
    $query2 = "
    DELETE FROM mesure 
    WHERE id_mesure = '".$input["id_mesure"]."'
    ";
    mysqli_query($connect, $query2);
}


echo json_encode($input);
