<?php

session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {
    $type_attaquant = mysqli_real_escape_string($connect, $input['type_d_attaquant_source_de_risque']);
    $profil_attaquant = mysqli_real_escape_string($connect, $input['profil_de_l_attaquant_source_de_risque']);
    $description_source_risque = mysqli_real_escape_string($connect, $input['description_source_de_risque']);
    $objectif_vise = mysqli_real_escape_string($connect, $input['objectif_vise']);
    $description_objectif_vise = mysqli_real_escape_string($connect, $input['description_objectif_vise']);
    $id_projet =  $_SESSION['id_projet'];


    $results["error"] = false;

    // Verification du type de l'attaquant
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $type_attaquant)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Type de l'attaquant invalide";
    }

    // Verification du profil de l'attaquant
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,1000}$/", $profil_attaquant)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Profil de l'attaquant invalide";
    }

    // Verification de la description de l'attaquant
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $description_source_risque)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Description de l'attaquant invalide";
    }

    // Verification de l'objectif visé
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $objectif_vise)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Objectif vise invalide";
    }

    // Verification de la description de l'objectif visé
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $description_objectif_vise)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Description objectif vise invalide";
    }

    if ($results["error"] === false) {
        
        $query = "
        UPDATE P_SROV 
        SET type_d_attaquant_source_de_risque = '".$type_attaquant."',
        profil_de_l_attaquant_source_de_risque = '".$profil_attaquant."',
        description_source_de_risque = '".$description_source_risque."',
        objectif_vise = '".$objectif_vise."',
        description_objectif_vise = '".$description_objectif_vise."'
        WHERE id_source_de_risque = '".$input["id_source_de_risque"]."'
        AND id_projet = '".$id_projet."'
        ";
        mysqli_query($connect, $query);
        $_SESSION['message_success'] = "Le couple source de risque/objectif visé a bien été modifié !";

    }
}

if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM P_SROV 
    WHERE id_source_de_risque = '".$input["id_source_de_risque"]."'
    ";
    mysqli_query($connect, $query);
    $_SESSION['message_success'] = "Le couple source de risque/objectif visé a bien été supprimé !";
}

echo json_encode($input);
