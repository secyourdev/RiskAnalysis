<?php
session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit'){
    $motivation = mysqli_real_escape_string($connect, $input['motivation']);
    $ressources = mysqli_real_escape_string($connect, $input['ressources']);
    $activite = mysqli_real_escape_string($connect, $input['activite']);

    if ($input['mode_operatoire'] !== null){
        $mode_operatoire = mysqli_real_escape_string($connect, $input['mode_operatoire']);
    }else{
        $mode_operatoire = '';
    }
    if ($input['secteur_d_activite'] !== null) {
        $secteur_activite = mysqli_real_escape_string($connect, $input['secteur_d_activite']);
    }else{
        $secteur_activite = '';
    }
    if ($input['arsenal_d_attaque'] !== null) {
        $arsenal_attaque = mysqli_real_escape_string($connect, $input['arsenal_d_attaque']);
    }else{
        $arsenal_attaque = '';
    }
    if ($input['faits_d_armes'] !== null) {
        $faits_armes = mysqli_real_escape_string($connect, $input['faits_d_armes']);
    }else{
        $faits_armes = '';
    }

    $pertinence = mysqli_real_escape_string($connect, $input['pertinence']);
    $choix_sr = NULL;

    $results["error"] = false;

    // Verification du mode opératoire
    if (!preg_match("/^$|^[a-zA-Z0-9éèàêâôùïüëç'\s-]{0,100}$/", $mode_operatoire)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Mode opératoire invalide";
    }

    // Verification du secteur d'activité
    if (!preg_match("/^$|^[a-zA-Z0-9éèàêâôùïüëç'\s-]{0,100}$/", $secteur_activite)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Secteur d'activité invalide";
    }

    // Verification de l'arsenal d'attaque'
    if (!preg_match("/^$|^[a-zA-Z0-9éèàêâôùïüëç'\s-]{0,100}$/", $arsenal_attaque)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Arsenal d'attaque invalide";
    }

    // Verification des afaits d'armes
    if (!preg_match("/^$|^[a-zA-Z0-9éèàêâôùïüëç'\s-]{0,100}$/", $faits_armes)) {
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
                echo "Faible";
            }
            elseif (($ressources === "3" && $motivation === "1") || ($ressources === "2" && $motivation === "2") || ($ressources === "1" && $motivation === "3")) {
                $pertinence = "Moyenne";
                echo "Moyenne";
            }
            else {
                $pertinence = "Élevée";
                echo "Élevée";
            }
        }
        
        $query = "
        UPDATE P_SROV 
        SET motivation = '".$motivation."',
        ressources = '".$ressources."',
        activite = '".$activite."',
        mode_operatoire = '".$mode_operatoire."',
        secteur_d_activite = '".$secteur_activite."',
        arsenal_d_attaque = '".$arsenal_attaque."',
        faits_d_armes = '".$faits_armes."',
        pertinence = '".$pertinence."',
        choix_source_de_risque = '".$choix_sr."'
        WHERE id_source_de_risque = '".$input["id_source_de_risque"]."'
        ";
        echo $query;
        mysqli_query($connect, $query);
        $_SESSION['message_success'] = "L'évaluation de la source de risque a été ajouté !";
    }
}

echo json_encode($input);
