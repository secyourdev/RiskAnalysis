<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);
$id_mesure = $_POST['id_mesure'];

if ($input["action"] === 'edit') {
    $nom_mesure_securite = $_POST['nom_mesure_securite'];
    $description_mesure_securite = $_POST['description_mesure_securite'];
    

    $results["error"] = false;
    $results["message"] = [];

    // Verification du nom_mesure_securite
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_mesure_securite)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Nom mesure sécurité invalide";
    }
    // Verification du description_mesure_securite
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description_mesure_securite)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Description mesure sécurité invalide";
    }

    if ($results["error"] === false) {
        $update = $bdd->prepare("UPDATE `Y_mesure` SET `nom_mesure`=?, `description_mesure`=? WHERE `id_mesure`=? AND `id_projet`=?");
        $update->bindParam(1, $nom_mesure_securite);
        $update->bindParam(2, $description_mesure_securite);
        $update->bindParam(3, $id_mesure);
        $update->bindParam(4, $getid_projet);
        $update->execute();

        $_SESSION['message_success'] = "La mesure de sécurité a bien été modifiée !";
    }
}

if ($input["action"] === 'delete') {
    $delete1 = $bdd->prepare("DELETE FROM `ZB_comporter_2` WHERE `id_mesure`=?");
    $delete1->bindParam(1, $id_mesure);
    $delete1->execute();

    
    $delete2 = $bdd->prepare("DELETE FROM `Y_mesure` WHERE `id_mesure`=?");
    $delete2->bindParam(1, $id_mesure);
    $delete2->execute();

    $_SESSION['message_success'] = "La mesure de sécurité a bien été supprimée !";
}


echo json_encode($input);
