<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;
$results["message"] = [];

if ($input["action"] === 'edit') {

    $nom_risque_residuelle = mysqli_real_escape_string($connect, $input['nom_risque_residuelle']);
    $description_risque_residuelle = mysqli_real_escape_string($connect, $input['description_risque_residuelle']);
    $vraisemblance_residuelle = mysqli_real_escape_string($connect, $input['vraisemblance_residuelle']);
    $gestion_risque_residuelle = mysqli_real_escape_string($connect, $input['gestion_risque_residuelle']);


    if ($results["error"] === false) {
        
        // recupere l'id du chemin d'attaque 
        $recupere_gravite = "SELECT 
            M_evenement_redoute.niveau_de_gravite
            FROM T_chemin_d_attaque_strategique, M_evenement_redoute, U_scenario_operationnel, X_revaluation_du_risque, S_scenario_strategique
    
            WHERE X_revaluation_du_risque.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
            AND U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
            AND T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique
            AND S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute";
        $result_gravite = mysqli_query($connect, $recupere_gravite);
        $niveau_de_gravite = (mysqli_fetch_array($result_gravite))["niveau_de_gravite"];
        
        // print_r($niveau_de_gravite);
        $risque_residuel = $niveau_de_gravite * $vraisemblance_residuelle;

        $query = "UPDATE X_revaluation_du_risque 
        SET
        nom_risque_residuelle = '$nom_risque_residuelle',
        description_risque_residuelle = '$description_risque_residuelle',
        vraisemblance_residuelle = '$vraisemblance_residuelle',
        -- risque_residuel = ' '$risque_residuel',
        risque_residuel = '$risque_residuel',
        gestion_risque_residuelle = '$gestion_risque_residuelle'
        WHERE id_revaluation = '".$input["id_revaluation"]."'
        AND id_projet = $getid_projet
        ";
        mysqli_query($connect, $query);
        $_SESSION['message_success'] = "L'évaluation et documentation des risques résiduels a été correctement modifié !";
    }
}

echo json_encode($input);
