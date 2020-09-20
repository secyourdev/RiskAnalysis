<?php
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);


if ($input["action"] === 'edit'){
    $nom_evenement_redoute = $_POST['nom_evenement_redoute'];
    $description_evenement_redoutes =  $_POST['description_evenement_redoute'];
    $impact =  $_POST['impact'];
    $confidentialite =  $_POST['confidentialite'];
    $integrite =  $_POST['integrite'];
    $disponibilite =  $_POST['disponibilite'];
    $tracabilite =  $_POST['tracabilite'];
    $niveau_de_gravite =  $_POST['niveau_de_gravite'];
   
    $results["error"] = false;

     // Verification du nom_evenement_redoutes
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_evenement_redoute)) {
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Nom de l'événement redouté invalide";
    }

    // Verification du description_evenement_redoutes
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $description_evenement_redoutes)) {
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Description événement redouté invalide";
    }

    // Verification du impact
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $impact)) {
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Impact invalide";
    }

    // Verification du niveau_de_gravite
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $niveau_de_gravite)) {
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Niveau de gravité invalide";
    }

    if ($results["error"] === false) {
        $update = $bdd->prepare("UPDATE `M_evenement_redoute` SET `nom_evenement_redoute`=?, `description_evenement_redoute`=?, `impact`=?, `confidentialite`=?, `integrite`=?, `disponibilite`=?, `tracabilite`=?, `niveau_de_gravite`=?  WHERE `id_evenement_redoute`=?");
        $update->bindParam(1, $nom_evenement_redoute);
        $update->bindParam(2, $description_evenement_redoutes);
        $update->bindParam(3, $impact);
        $update->bindParam(4, $confidentialite);
        $update->bindParam(5, $integrite);
        $update->bindParam(6, $disponibilite);
        $update->bindParam(7, $tracabilite);
        $update->bindParam(8, $niveau_de_gravite);
        $update->bindParam(9, $input["id_evenement_redoute"]);

        $update->execute();
        
        $_SESSION['message_success_3'] = "L'événement redouté a été modifié !";
    }
}

if ($input["action"] === 'delete') {
    $delete = $bdd->prepare("DELETE FROM `M_evenement_redoute` WHERE `id_evenement_redoute`=?");
    $delete->bindParam(1, $input["id_evenement_redoute"]);
    $delete->execute();

    $_SESSION['message_success_3'] = "L'événement redouté a été supprimé !";
}

echo json_encode($input);
