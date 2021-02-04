<?php
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {
    $id_risque = $_POST['id_risque'];
    $chemin_d_attaque_strategique = $_POST['chemin_d_attaque_strategique'];
    $description = $_POST['description'];

    $results["error"] = false;
    $results["message"] = [];

    // Verification du ID Risque
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-\_.:,'\"–]{0,100}$/", $id_risque)) {
        $results["error"] = true;
        $_SESSION['message_error_3'] = "ID Risque invalide";
    }

    // Verification du chemin_d_attaque_strategique
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $chemin_d_attaque_strategique)) {
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Chemin d'attaque stratégique invalide";
    }

    // Verification de la description
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description)) {
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Description invalide";
    }

    if ($results["error"] === false) {
 
        $update = $bdd->prepare("UPDATE `T_chemin_d_attaque_strategique` SET `id_risque`=?, `nom_chemin_d_attaque_strategique`=?, `description_chemin_d_attaque_strategique`=? WHERE `id_chemin_d_attaque_strategique`=?");
        $update->bindParam(1, $id_risque);
        $update->bindParam(2, $chemin_d_attaque_strategique);
        $update->bindParam(3, $description);
        $update->bindParam(4, $input["id_chemin_d_attaque_strategique"]);
        $update->execute();

        $_SESSION['message_success_3'] = "Le chemin d'attaque a bien été modifié !";
    }
}

echo json_encode($input);
