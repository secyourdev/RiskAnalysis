<?php  
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM H_RACI 
    WHERE id_utilisateur = '".$input["id_utilisateur"]."' 
    AND id_projet = $getid_projet
    ";
    mysqli_query($connect, $query);
    $_SESSION['message_success_2'] = "L'utilisateur a bien été supprimé du projet !";
}

echo json_encode($input);

?>