<?php
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {
    $principe = $_POST['principe_de_securite'];
    $responsable = $_POST['responsable'];
    $difficulte = $_POST['difficulte_traitement_de_securite'];
    $cout = $_POST['cout_traitement_de_securite'];
    $date = $_POST['date_traitement_de_securite'];
    $statut = $_POST['statut'];

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
        $update = $bdd->prepare("UPDATE `ZA_traitement_de_securite` SET `principe_de_securite`=?, `responsable`=?, `difficulte_traitement_de_securite`=?, `cout_traitement_de_securite`=?, `date_traitement_de_securite`=?, `statut`=? WHERE `id_traitement_de_securite`=?");
        $update->bindParam(1, $principe);
        $update->bindParam(2, $responsable);
        $update->bindParam(3, $difficulte);
        $update->bindParam(4, $cout);
        $update->bindParam(5, $date);
        $update->bindParam(6, $statut);
        $update->bindParam(7, $input["id_traitement_de_securite"]);
        $update->execute();

        $_SESSION['message_success'] = "Le plan d'amélioration continue de la sécurité a été correctement modifié !";
    }
}




echo json_encode($input);
