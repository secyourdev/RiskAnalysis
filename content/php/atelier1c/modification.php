<?php
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$nom_evenement_redoute = mysqli_real_escape_string($connect, $input['nom_evenement_redoute']);
$description_evenement_redoutes = mysqli_real_escape_string($connect, $input['description_evenement_redoute']);
$impact = mysqli_real_escape_string($connect, $input['impact']);
$confidentialite = mysqli_real_escape_string($connect, $input['confidentialite']);
$integrite = mysqli_real_escape_string($connect, $input['integrite']);
$disponibilite = mysqli_real_escape_string($connect, $input['disponibilite']);
$tracabilite = mysqli_real_escape_string($connect, $input['tracabilite']);
$niveau_de_gravite = mysqli_real_escape_string($connect, $input['niveau_de_gravite']);

$results["error"] = false;

// Verification du nom_evenement_redoutes
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/", $nom_evenement_redoute)) {
    $results["error"] = true;
}

// Verification du description_evenement_redoutes
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,1000}$/", $description_evenement_redoutes)) {
    $results["error"] = true;
}

// Verification du impact
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/", $impact)) {
    $results["error"] = true;
}

// Verification du niveau_de_gravite
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/", $niveau_de_gravite)) {
    $results["error"] = true;
}

if ($input["action"] === 'edit' && $results["error"] === false) {
    $query = "
    UPDATE M_evenement_redoute 
    SET 
    nom_evenement_redoute = '" . $nom_evenement_redoute . "',
    description_evenement_redoute = '" . $description_evenement_redoutes . "',
    impact = '" . $impact . "',
    confidentialite = '" . $confidentialite . "',
    integrite = '" . $integrite . "',
    disponibilite = '" . $disponibilite . "',
    tracabilite = '" . $tracabilite . "',
    niveau_de_gravite = '" . $niveau_de_gravite . "'
    WHERE id_evenement_redoute = '" . $input["id_evenement_redoute"] . "'
    ";
    echo $query;

    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM M_evenement_redoute 
    WHERE id_evenement_redoute = '".$input["id_evenement_redoute"]."'
    ";
    echo $query;
    mysqli_query($connect, $query);
}


echo json_encode($input);
