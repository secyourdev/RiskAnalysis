<?php
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {

    $results["error"] = false;
    $results["message"] = [];

    $nom_scenario_strategique = $_POST['nom_scenario_strategique'];

    // Verification du nom_scenario_strategique
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_scenario_strategique)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Nom scénario stratégique invalide";
    }


    if ($results["error"] === false) {
        $update = $bdd->prepare("UPDATE `S_scenario_strategique` SET `nom_scenario_strategique`=? WHERE `id_scenario_strategique`=?");
        $update->bindParam(1, $nom_scenario_strategique);
        $update->bindParam(2, $input["id_scenario_strategique"]);
        $update->execute();


        $_SESSION['message_success'] = "Le scénario stratégique a bien été modifié !";
    }
}

if ($input["action"] === 'delete') {
    $delete = $bdd->prepare("DELETE FROM `S_scenario_strategique` WHERE `id_scenario_strategique`=?");
    $delete->bindParam(1, $input["id_scenario_strategique"]);
    $delete->execute();

    $_SESSION['message_success'] = "Le scénario stratégique a bien été supprimé !";
}


echo json_encode($input);
