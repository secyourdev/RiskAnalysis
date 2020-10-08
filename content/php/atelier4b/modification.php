<?php
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

$vraisemblance = $_POST['vraisemblance'];


$results["error"] = false;
$results["message"] = [];


if ($input["action"] === 'edit' && $results["error"] === false) {
    $update = $bdd->prepare("UPDATE `U_scenario_operationnel` SET `vraisemblance`=? WHERE `id_scenario_operationnel`=?");
    $update->bindParam(1, $vraisemblance);
    $update->bindParam(2, $input["id_scenario_operationnel"]);
    $update->execute();

    $_SESSION['message_success'] = "La vraisemblance du scénario opérationnel a été bien modifiée !";
}


echo json_encode($input);
