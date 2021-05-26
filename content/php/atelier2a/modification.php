<?php

session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {
    $type_attaquant = $_POST['type_d_attaquant_source_de_risque'];
    $profil_attaquant = $_POST['profil_de_l_attaquant_source_de_risque'];
    $description_source_risque = $_POST['description_source_de_risque'];
    $objectif_vise = $_POST['objectif_vise'];
    $description_objectif_vise = $_POST['description_objectif_vise'];
    $id_projet =  $_SESSION['id_projet'];


    $results["error"] = false;

    // Verification du type de l'attaquant
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $type_attaquant)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Type de la source de risque invalide";
    }

    // Verification du profil de l'attaquant
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $profil_attaquant)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Profil de la source de risque invalide";
    }

    // Verification de la description de l'attaquant
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description_source_risque)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Description de la source de risque invalide";
    }

    // Verification de l'objectif visé
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $objectif_vise)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Objectif vise invalide";
    }

    // Verification de la description de l'objectif visé
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description_objectif_vise)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Description objectif vise invalide";
    }

    if ($results["error"] === false) {
        
        $update = $bdd->prepare("UPDATE `P_SROV` SET `type_d_attaquant_source_de_risque`=?, `profil_de_l_attaquant_source_de_risque`=?, `description_source_de_risque`=?, `objectif_vise`=?, `description_objectif_vise`=? WHERE `id_source_de_risque`=? AND `id_projet`=?" );
        $update->bindParam(1, $type_attaquant);
        $update->bindParam(2, $profil_attaquant);
        $update->bindParam(3, $description_source_risque);
        $update->bindParam(4, $objectif_vise);
        $update->bindParam(5, $description_objectif_vise);
        $update->bindParam(6, $input["id_source_de_risque"]);
        $update->bindParam(7, $id_projet);
        $update->execute();

        $_SESSION['message_success'] = "Le couple source de risque/objectif visé a bien été modifié !";

    }
}

if ($input["action"] === 'delete') {
    $delete = $bdd->prepare("DELETE FROM `P_SROV` WHERE `id_source_de_risque`=?");
    $delete->bindParam(1, $input["id_source_de_risque"]);
    $delete->execute();
    $_SESSION['message_success'] = "Le couple source de risque/objectif visé a bien été supprimé !";
}

echo json_encode($input);
