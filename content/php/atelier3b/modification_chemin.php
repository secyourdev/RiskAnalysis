<?php
session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {
    $chemin_d_attaque_strategique = mysqli_real_escape_string($connect, $input['chemin_d_attaque_strategique']);

    $results["error"] = false;
    $results["message"] = [];

    // Verification du chemin_d_attaque_strategique
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{1,100}$/", $chemin_d_attaque_strategique)) {
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Chemin d'attaque stratégique invalide";
    }

    if ($results["error"] === false) {
        $query = "
        UPDATE T_chemin_d_attaque_strategique 
        SET 
        nom_chemin_d_attaque_strategique = '" . $chemin_d_attaque_strategique . "'
        WHERE id_chemin_d_attaque_strategique = '" . $input["id_chemin_d_attaque_strategique"] . "'
        ";

        mysqli_query($connect, $query);
        $_SESSION['message_success_3'] = "Le chemin d'attaque a bien été modifié !";
    }
}

if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM T_chemin_d_attaque_strategique 
    WHERE id_chemin_d_attaque_strategique = '" . $input["id_chemin_d_attaque_strategique"] . "'
    ";
    mysqli_query($connect, $query);
    $_SESSION['message_success_3'] = "Le chemin d'attaque a bien été supprimé !";
}


echo json_encode($input);
