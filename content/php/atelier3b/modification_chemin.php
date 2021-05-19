<?php
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {
<<<<<<< HEAD
=======
    $id_risque = $_POST['id_risque'];
>>>>>>> origin/Carlos
    $chemin_d_attaque_strategique = $_POST['chemin_d_attaque_strategique'];
    $description = $_POST['description'];

    $results["error"] = false;
    $results["message"] = [];

<<<<<<< HEAD
=======
    // Verification du ID Risque
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-\_.:,'\"–]{0,100}$/", $id_risque)) {
        $results["error"] = true;
        $_SESSION['message_error_3'] = "ID Risque invalide";
    }

>>>>>>> origin/Carlos
    // Verification du chemin_d_attaque_strategique
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $chemin_d_attaque_strategique)) {
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Chemin d'attaque stratégique invalide";
    }

    // Verification de la description
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description)) {
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Description invalide";
    }

    if ($results["error"] === false) {
<<<<<<< HEAD

        $update = $bdd->prepare("UPDATE `T_chemin_d_attaque_strategique` SET `nom_chemin_d_attaque_strategique`=?, `description_chemin_d_attaque_strategique`=? WHERE `id_chemin_d_attaque_strategique`=?");
        $update->bindParam(1, $chemin_d_attaque_strategique);
        $update->bindParam(2, $description);
        $update->bindParam(3, $input["id_chemin_d_attaque_strategique"]);
        $update->execute();

        $_SESSION['message_success_3'] = "Le chemin d'attaque a bien été modifié !";
    }
}

if ($input["action"] === 'delete') {
  
    $delete = $bdd->prepare("DELETE FROM `T_chemin_d_attaque_strategique` WHERE `id_chemin_d_attaque_strategique`=?");
    $delete->bindParam(1, $input["id_chemin_d_attaque_strategique"]);
    $delete->execute();

    $_SESSION['message_success_3'] = "Le chemin d'attaque a bien été supprimé !";
}


=======
 
        $update = $bdd->prepare("UPDATE `T_chemin_d_attaque_strategique` SET `id_risque`=?, `nom_chemin_d_attaque_strategique`=?, `description_chemin_d_attaque_strategique`=? WHERE `id_chemin_d_attaque_strategique`=?");
        $update->bindParam(1, $id_risque);
        $update->bindParam(2, $chemin_d_attaque_strategique);
        $update->bindParam(3, $description);
        $update->bindParam(4, $input["id_chemin_d_attaque_strategique"]);
        $update->execute();

        $description_scenario_operationnel = "Scenario opérationnel pour : " . $chemin_d_attaque_strategique;

        $update_scenario_operationnel = $bdd->prepare("UPDATE `U_scenario_operationnel` SET `id_risque`=?, `nom_scenario_operationnel`=? WHERE `id_chemin_d_attaque_strategique`=?");
        $update_scenario_operationnel->bindParam(1, $id_risque);
        $update_scenario_operationnel->bindParam(2, $description_scenario_operationnel);
        $update_scenario_operationnel->bindParam(3, $input["id_chemin_d_attaque_strategique"]);
        $update_scenario_operationnel->execute();

        $_SESSION['message_success_3'] = "Le chemin d'attaque a bien été modifié !";
    }
}

>>>>>>> origin/Carlos
echo json_encode($input);
