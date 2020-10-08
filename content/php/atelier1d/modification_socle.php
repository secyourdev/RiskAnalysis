<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;
$results["message"] = [];

if ($input["action"] === 'edit') {
    if (isset($input['etat_d_application'])) {
        $etat_d_application = $_POST['etat_d_application'];
    }
    if (isset($input['etat_de_la_conformite'])) {
        $etat_de_la_conformite = $_POST['etat_de_la_conformite'];
    }

    // Verification du etat_d_application
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $etat_d_application)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "État d'application invalide";
    }

    // Verification du etat_de_la_conformite
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $etat_de_la_conformite)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "État de la conformité invalide";
    }
    
    if ($results["error"] === false) {
        $update = $bdd->prepare("UPDATE `N_socle_de_securite` SET `etat_d_application`=?, `etat_de_la_conformite`=? WHERE `id_socle_securite`=? AND `id_atelier`='1.d' AND `id_projet`=?");
        $update->bindParam(1, $etat_d_application);
        $update->bindParam(2, $etat_de_la_conformite);
        $update->bindParam(3, $input["id_socle_securite"]);
        $update->bindParam(4, $getid_projet);
         $update->execute();

        $_SESSION['message_success'] = "Le socle de sécurité a bien été modifié !";
    }
}

if($input["action"] === 'delete'){
    $delete = $bdd->prepare("DELETE FROM `N_socle_de_securite` WHERE `id_socle_securite`=? AND `id_atelier`='1.d' AND `id_projet`=?");
    $delete->bindParam(1, $input["id_socle_securite"]);
    $delete->bindParam(2,$getid_projet);
    $delete->execute();

    $_SESSION['message_success'] = "Le socle de sécurité a bien été supprimé !";
}

echo json_encode($input);
