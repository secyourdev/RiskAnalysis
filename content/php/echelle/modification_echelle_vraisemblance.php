<?php  
session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);


if($input["action"] === 'edit'){
    $nom_echelle = mysqli_real_escape_string($connect, $input["nom_echelle"]);
    $echelle_gravite = mysqli_real_escape_string($connect, $input["nb_niveau_echelle"]);

    $results["error"] = false;

    // Verification du nom de l'échelle
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_echelle)){
        $results["error"] = true;
        $_SESSION['message_error'] = "Nom de l'échelle invalide";
    }

    if($results["error"] === false){
        $query = "
        UPDATE DC_echelle_vraisemblance
        SET nom_echelle = '".$nom_echelle."',
        nb_niveau_echelle = '".$echelle_gravite."'
        WHERE id_echelle = '".$input["id_echelle"]."'
        ";
        mysqli_query($connect, $query);
        $_SESSION['message_success'] = "L'échelle a bien été modifiée !";
    }
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM DC_echelle_vraisemblance 
    WHERE id_echelle = '".$input["id_echelle"]."'
    ";
    mysqli_query($connect, $query);
    $_SESSION['message_success'] = "L'échelle a bien été supprimée !";
}

echo json_encode($input);

?>