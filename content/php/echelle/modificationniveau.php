<?php  
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

if($input["action"] === 'edit'){
    $description_niveau = $_POST["description_niveau"];

    $results["error"] = false;

    // Verification de la description
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description_niveau)){
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Description invalide";
    }

    if($results["error"] === false){
        $update = $bdd->prepare("UPDATE `DA_niveau` SET `description_niveau`=? WHERE `id_niveau`=?");
        $update->bindParam(1, $description_niveau);
        $update->bindParam(2, $input["id_niveau"]);
        $update->execute();

        $_SESSION['message_success_2'] = "Les niveaux de l'échelle ont bien été modifiés !";
    }
}

echo json_encode($input);

?>