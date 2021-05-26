<?php
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

$choix_sr = $_POST['choix_source_de_risque'];

$results["error"] = false;

if ($input["action"] === 'edit' && $results["error"] === false) {

    $update = $bdd->prepare("UPDATE `P_SROV` SET `choix_source_de_risque`=? WHERE `id_source_de_risque`=?");
    $update->bindParam(1, $choix_sr);
    $update->bindParam(2, $input["id_source_de_risque"]);
    $update->execute();


    $_SESSION['message_success'] = "Le choix de source de risque a été ajouté !";

}


echo json_encode($input);
