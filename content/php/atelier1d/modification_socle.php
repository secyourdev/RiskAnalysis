<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;
$results["message"] = [];

if ($input["action"] === 'edit') {
    if (isset($input['etat_d_application'])) {
        $etat_d_application = mysqli_real_escape_string($connect, $input['etat_d_application']);
    }
    if (isset($input['etat_de_la_conformite'])) {
        $etat_de_la_conformite = mysqli_real_escape_string($connect, $input['etat_de_la_conformite']);
    }

    // Verification du etat_d_application
    if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $etat_d_application)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "État d'application invalide";
    }

    // Verification du etat_de_la_conformite
    if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $etat_de_la_conformite)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "État de la conformité invalide";
    }
    
    if ($results["error"] === false) {
        $query =
           "UPDATE N_socle_de_securite 
            SET 
            etat_d_application = '" . $etat_d_application . "',
            etat_de_la_conformite = '" . $etat_de_la_conformite . "'
            WHERE id_socle_securite = '" . $input["id_socle_securite"] . "'
            AND id_atelier = '1.d' AND id_projet = $getid_projet";

        mysqli_query($connect, $query);
        $_SESSION['message_success'] = "Le socle de sécurité a bien été modifié !";
    }
}

echo json_encode($input);
