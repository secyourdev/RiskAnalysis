<?php
session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {
    $principe = mysqli_real_escape_string($connect, $input['principe_de_securite']);
    $responsable = mysqli_real_escape_string($connect, $input['responsable']);
    $difficulte = mysqli_real_escape_string($connect, $input['difficulte_traitement_de_securite']);
    $cout = mysqli_real_escape_string($connect, $input['cout_traitement_de_securite']);
    $date = mysqli_real_escape_string($connect, $input['date_traitement_de_securite']);
    $statut = mysqli_real_escape_string($connect, $input['statut']);

    $results["error"] = false;
    $results["message"] = [];

    // Verification du principe
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $principe)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Principe invalide";
    }

    // Verification du responsable
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $responsable)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Responsable invalide";
    }

    // Verification des difficultés
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $difficulte)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Difficulté invalide";
    }

    // Verification des coûts
    if (!preg_match("/^[+]{0,100}$/", $cout)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Coût invalide";
    }

    // Verification de la date
    if (!preg_match("/^[0-9\s-]{0,100}$/", $date)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Date invalide";
    }

    // Verification du statut
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $statut)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Statut invalide";
    }

    if ($results["error"] === false) {
        
        $query = "
        UPDATE ZA_traitement_de_securite 
        SET principe_de_securite = '".$principe."',
        responsable = '".$responsable."',
        difficulte_traitement_de_securite = '".$difficulte."',
        cout_traitement_de_securite = '".$cout."',
        date_traitement_de_securite = '".$date."',
        statut = '".$statut."'
        WHERE id_traitement_de_securite = '".$input["id_traitement_de_securite"]."'
        ";
        mysqli_query($connect, $query);
        $_SESSION['message_success'] = "Le plan d'amélioration continue de la sécurité a été correctement modifié !";
    }
}




echo json_encode($input);
