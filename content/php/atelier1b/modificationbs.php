<?php  
session_start();

include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];;

if($input["action"] === 'edit'){
    $nom_bien_support = mysqli_real_escape_string($connect, $input["nom_bien_support"]);
    $description_bien_support = mysqli_real_escape_string($connect, $input["description_bien_support"]);
    echo $nom_bien_support;
    echo $description_bien_support;

    // Verification du nom du bien support
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $nom_bien_support)){
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Nom invalide";
    }

    // Verification de la description
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,1000}$/", $description_bien_support)){
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Description invalide";
    }

    if($results["error"] === false){
        $querybs = 
        "UPDATE K_bien_support 
        SET nom_bien_support = '".$nom_bien_support."', 
        description_bien_support = '".$description_bien_support."'
        WHERE id_bien_support = '".$input["id_bien_support"]. "'
        AND id_atelier = '" . $id_atelier . "'
        AND id_projet = " . $id_projet . "
        ";
        mysqli_query($connect, $querybs);
        
        $_SESSION['message_success_3'] = "Le bien support a bien été modifié !";
    }
}

if($input["action"] === 'delete'){
    $query = 
    "DELETE FROM K_bien_support 
    WHERE id_bien_support = '".$input["id_bien_support"]. "'
    AND id_atelier = '" . $id_atelier . "'
    AND id_projet = " . $id_projet . "
    ";
    mysqli_query($connect, $query);

    $_SESSION['message_success_3'] = "Le bien support a bien été supprimé !";
}

echo json_encode($input);

?>