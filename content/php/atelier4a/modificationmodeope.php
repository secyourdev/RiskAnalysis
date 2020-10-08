<?php
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {
    $nomscenar = $_POST['scenario_operationnel'];
    $modeope = $_POST['mode_operatoire'];

    $results["error"] = false;

    // Verification du type de l'attaquant
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $modeope)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Mode opératoire invalide";
    }

    if ($results["error"] === false) {
        $update = $bdd->prepare("UPDATE `W_mode_operatoire` SET `mode_operatoire`=? WHERE `id_mode_operatoire`=?");
        $update->bindParam(1, $modeope);
        $update->bindParam(2, $input["id_mode_operatoire"]);
        $update->execute();

        $_SESSION['message_success_2'] = "Le mode opératoire a été bien modifié !";
    }
}

if ($input["action"] === 'delete') {
    $delete = $bdd->prepare("DELETE FROM `W_mode_operatoire` WHERE `id_mode_operatoire`=?");
    $delete->bindParam(1, $input["id_mode_operatoire"]);
    $delete->execute();

    $_SESSION['message_success_2'] = "Le mode opératoire a été bien supprimé !";
}


echo json_encode($input);
