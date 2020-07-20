<?php  
include("content/php/bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;
$results["message"] = [];

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM impliquer  
    WHERE id_utilisateur = '".$input["id_utilisateur"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>