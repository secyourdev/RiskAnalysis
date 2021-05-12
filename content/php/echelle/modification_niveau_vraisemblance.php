<?php  
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

if($input["action"] === 'edit'){
    $id_array = preg_split("/;/",$_POST["id_echelle"]);
    $id_echelle = $id_array[0];
    $id_niveau = $id_array[1];
    $description_niveau = $_POST["description_niveau"];

    $results["error"] = false;

    // Verification de la description
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description_niveau)){
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Description invalide";
    }

    if($results["error"] === false){
        if ($id_niveau === "1") {
            $update = $bdd->prepare("UPDATE `DC_echelle_vraisemblance` SET `description_niveau_1`=? WHERE `id_echelle`=?");
            $update->bindParam(1, $description_niveau);
            $update->bindParam(2, $id_echelle);
            $update->execute();
        }
        elseif ($id_niveau === "2") {
            $update = $bdd->prepare("UPDATE `DC_echelle_vraisemblance` SET `description_niveau_2`=? WHERE `id_echelle`=?");
            $update->bindParam(1, $description_niveau);
            $update->bindParam(2, $id_echelle);
            $update->execute();
        }
        elseif ($id_niveau === "3") {
            $update = $bdd->prepare("UPDATE `DC_echelle_vraisemblance` SET `description_niveau_3`=? WHERE `id_echelle`=?");
            $update->bindParam(1, $description_niveau);
            $update->bindParam(2, $id_echelle);
            $update->execute();
        }
        elseif ($id_niveau === "4") {
            $update = $bdd->prepare("UPDATE `DC_echelle_vraisemblance` SET `description_niveau_4`=? WHERE `id_echelle`=?");
            $update->bindParam(1, $description_niveau);
            $update->bindParam(2, $id_echelle);
            $update->execute();
        }
        else {
            $update = $bdd->prepare("UPDATE `DC_echelle_vraisemblance` SET `description_niveau_5`=? WHERE `id_echelle`=?");
            $update->bindParam(1, $description_niveau);
            $update->bindParam(2, $id_echelle);
            $update->execute();
        }

        $_SESSION['message_success_2'] = "Les niveaux de l'échelle ont bien été modifiés !";
    }
}

echo json_encode($input);

?>