<?php
session_start();
include("../bdd/connexion.php");
$input = filter_input_array(INPUT_POST);

$description_scenario_operationnel = $_POST['description_scenario_operationnel'];

$results["error"] = false;

// Verification du type de l'attaquant
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description_scenario_operationnel)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Scénario opérationnel invalide";
}

if ($input["action"] === 'edit' && $results["error"] === false) {
    $update = $bdd->prepare("UPDATE `U_scenario_operationnel` SET `description_scenario_operationnel`=? WHERE `id_scenario_operationnel`=?");
    $update->bindParam(1, $description_scenario_operationnel);
    $update->bindParam(2, $input["id_scenario_operationnel"]);
    $update->execute();

    $_SESSION['message_success'] = "Le scénario opérationnel a été bien modifié !";
}

echo json_encode($input);
