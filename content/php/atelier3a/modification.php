<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);
$id_atelier = '3.a';

if ($input["action"] === 'edit') {
    $categorie_partie_prenante = $_POST['categorie_partie_prenante'];
    $nom_partie_prenante = $_POST['nom_partie_prenante'];
    $type = $_POST['type'];
    $dependance_partie_prenante = $_POST['dependance_partie_prenante'];
    $penetration_partie_prenante = $_POST['penetration_partie_prenante'];
    $maturite_partie_prenante = $_POST['maturite_partie_prenante'];
    $confiance_partie_prenante = $_POST['confiance_partie_prenante'];
    $ponderation_dependance = $_POST['ponderation_dependance'];
    $ponderation_penetration = $_POST['ponderation_penetration'];
    $ponderation_maturite = $_POST['ponderation_maturite'];
    $ponderation_confiance = $_POST['ponderation_confiance'];
    $criticite = $_POST['criticite'];
    $niveau_de_menace_partie_prenante = round(($dependance_partie_prenante*$ponderation_dependance * $penetration_partie_prenante*$ponderation_penetration) / ($maturite_partie_prenante*$ponderation_maturite * $confiance_partie_prenante*$ponderation_confiance), 2);

    $results["error"] = false;

    // Verification du categorie_partie_prenante
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $categorie_partie_prenante)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Catégorie partie prenante invalide";
    }
    // Verification du nom_partie_prenante
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_partie_prenante)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Nom partie prenante invalide";
    }
    // Verification du type
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $type)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Type invalide";
    }
    // Verification du dependance_partie_prenante
    if (!preg_match("/^([0-4])$/", $dependance_partie_prenante)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Dépendance partie prenante invalide";
    }
    // Verification du penetration_partie_prenante
    if (!preg_match("/^([0-4])$/", $penetration_partie_prenante)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Pénétration partie prenante invalide";
    }
    // Verification du maturite_partie_prenante
    if (!preg_match("/^([0-4])$/", $maturite_partie_prenante)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Maturité partie prenante invalide";
    }
    // Verification du confiance_partie_prenante
    if (!preg_match("/^([0-4])$/", $confiance_partie_prenante)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Confiance partie prenante invalide";
    }
    // Verification du ponderation_dependance
    if (!preg_match("/^([0-9]|1[0-6])$/", $ponderation_dependance)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Pondération dépendance invalide";
    }
    // Verification du ponderation_penetration
    if (!preg_match("/^([0-9]|1[0-6])$/", $ponderation_penetration)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Pondération pénétration invalide";
    }
    // Verification du ponderation_maturite
    if (!preg_match("/^([0-9]|1[0-6])$/", $ponderation_maturite)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Pondération maturité invalide";
    }
    // Verification du ponderation_confiance
    if (!preg_match("/^([0-9]|1[0-6])$/", $ponderation_confiance)) {
        $results["error"] = true;
        $_SESSION['message_error_2'] = "ponderation_confiance invalide";
    }

    if ($results["error"] === false) {
        $update = $bdd->prepare("UPDATE `R_partie_prenante` SET `categorie_partie_prenante`=?, `nom_partie_prenante`=?, `type`=?, `dependance_partie_prenante`=?, `ponderation_dependance`=?, `penetration_partie_prenante`=?, `ponderation_penetration`=?, `maturite_partie_prenante`=?, `ponderation_maturite`=?, `confiance_partie_prenante`=?, `ponderation_confiance`=?, `niveau_de_menace_partie_prenante`=?, `criticite`=? WHERE `id_partie_prenante`=? AND `id_projet`=? AND `id_atelier`=?");
        $update->bindParam(1, $categorie_partie_prenante);
        $update->bindParam(2, $nom_partie_prenante);
        $update->bindParam(3, $type);
        $update->bindParam(4, $dependance_partie_prenante);
        $update->bindParam(5, $ponderation_dependance);
        $update->bindParam(6, $penetration_partie_prenante);
        $update->bindParam(7, $ponderation_penetration);
        $update->bindParam(8, $maturite_partie_prenante);
        $update->bindParam(9, $ponderation_maturite);
        $update->bindParam(10, $confiance_partie_prenante);
        $update->bindParam(11, $ponderation_confiance);
        $update->bindParam(12, $niveau_de_menace_partie_prenante);
        $update->bindParam(13, $criticite);
        $update->bindParam(14, $input["id_partie_prenante"]);
        $update->bindParam(15, $getid_projet);
        $update->bindParam(16, $id_atelier);
        $update->execute();


        $_SESSION['message_success_2'] = "La partie prenante a bien été modifiée !";
    }
}
if ($input["action"] === 'delete') {
    $delete = $bdd->prepare("DELETE FROM `R_partie_prenante` WHERE `id_partie_prenante`=? AND `id_projet`=? AND `id_atelier`=?");
    $delete->bindParam(1, $input["id_partie_prenante"]);
    $delete->bindParam(2, $getid_projet);
    $delete->bindParam(3, $id_atelier);

    $delete->execute();
      
    $_SESSION['message_success_2'] = "La partie prenante a bien été supprimée !";
}


echo json_encode($input);
