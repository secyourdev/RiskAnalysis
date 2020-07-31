<?php  
session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

if($input["action"] === 'edit'){
    $description_niveau = mysqli_real_escape_string($connect, $input["description_niveau"]);

    $results["error"] = false;

    // Verification de la description
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description_niveau)){
        $results["error"] = true;
        $_SESSION['message_error_2'] = "Description invalide";
    }

    if($results["error"] === false){
        $query = "
        UPDATE DA_niveau 
        SET description_niveau = '".$description_niveau."'
        WHERE id_niveau = '".$input["id_niveau"]."'
        ";
        mysqli_query($connect, $query);
        $_SESSION['message_success_2'] = "Les niveaux de l'échelle ont bien été modifiés !";
    }
}

echo json_encode($input);

?>