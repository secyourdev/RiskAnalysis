<?php
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit'){
    $motivation = $_POST['motivation'];
    $ressources = $_POST['ressources'];
    $activite = $input['activite'];

    if ($input['mode_operatoire'] !== null){
        $mode_operatoire = $_POST['mode_operatoire'];
    }else{
        $mode_operatoire = '';
    }
    if ($input['secteur_d_activite'] !== null) {
        $secteur_activite = $_POST['secteur_d_activite'];
    }else{
        $secteur_activite = '';
    }
    if ($input['arsenal_d_attaque'] !== null) {
        $arsenal_attaque = $_POST['arsenal_d_attaque'];
    }else{
        $arsenal_attaque = '';
    }
    if ($input['faits_d_armes'] !== null) {
        $faits_armes = $_POST['faits_d_armes'];
    }else{
        $faits_armes = '';
    }

    $pertinence = $_POST['pertinence'];
    $choix_sr = NULL;

    $results["error"] = false;

    // Verification du mode opératoire
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $mode_operatoire)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Mode opératoire invalide";
    }

    // Verification du secteur d'activité
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $secteur_activite)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Secteur d'activité invalide";
    }

    // Verification de l'arsenal d'attaque'
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $arsenal_attaque)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Arsenal d'attaque invalide";
    }

    // Verification des faits d'armes
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $faits_armes)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Faits d'armes invalide";
    }
    // Verification des afaits d'armes
    if (!preg_match("/^[1-3]$/", $motivation)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Motivation invalide";
    }
    // Verification des afaits d'armes
    if (!preg_match("/^[1-3]$/", $ressources)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Ressources invalide";
    }
    // Verification des afaits d'armes
    if (!preg_match("/^[1-3]$/", $activite)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Activité invalide";
    }

    if ($input["action"] === 'edit' && $results["error"] === false) {

        if ($pertinence === "Auto"){
            echo $ressources;
            echo $motivation;
            if (($ressources === "1" && $motivation === "1") || ($ressources === "1" && $motivation === "2") || ($ressources === "2" && $motivation === "1")) {
                $pertinence = "Faible";
            }
            elseif (($ressources === "3" && $motivation === "1") || ($ressources === "2" && $motivation === "2") || ($ressources === "1" && $motivation === "3")) {
                $pertinence = "Moyenne";
            }
            else {
                $pertinence = "Élevée";
            }
        }
        
        $update = $bdd->prepare("UPDATE `P_SROV` SET `motivation`=?, `ressources`=?, `activite`=?, `mode_operatoire`=?, `secteur_d_activite`=?, `arsenal_d_attaque`=?, `faits_d_armes`=?, `pertinence`=?, `choix_source_de_risque`=?  WHERE `id_source_de_risque`=?");
        $update->bindParam(1, $motivation);
        $update->bindParam(2, $ressources);
        $update->bindParam(3, $activite);
        $update->bindParam(4, $mode_operatoire);
        $update->bindParam(5, $secteur_activite);
        $update->bindParam(6, $arsenal_attaque);
        $update->bindParam(7, $faits_armes);
        $update->bindParam(8, $pertinence);
        $update->bindParam(9, $choix_sr);
        $update->bindParam(10, $input["id_source_de_risque"]);

        $update->execute();

        $_SESSION['message_success'] = "L'évaluation de la source de risque a été ajouté !";
    }
}

echo json_encode($input);
