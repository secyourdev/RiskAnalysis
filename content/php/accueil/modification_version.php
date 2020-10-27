<?php  
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;
$results["message"] = [];

if ($input["action"] === 'edit') {

    $id_version = $_POST["id_version"];
    $num_version = $_POST["num_version"];
    $description_version = $_POST["description_version"];

    // Verification de la mission
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $num_version)) {
        $results["error"] = true;
        $_SESSION['message_error_5'] = "Num Version Invalide";
    }

    // Verification de la description de la mission
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $description_version)) {
        $results["error"] = true;
        $_SESSION['message_error_5'] = "Description versionn invalide";
    }


    if($results["error"] === false){
    $update = $bdd->prepare("UPDATE `ZC_version` SET `num_version`=?, `description_version`=? WHERE `id_version`=?");
    $update->bindParam(1, $num_version);
    $update->bindParam(2, $description_version);
    $update->bindParam(3, $id_version);
    $update->execute();

    $_SESSION['message_success_5'] = "La version a bien été modifiée !";
    }
}

if($input["action"] === 'delete'){
    // TODO - Supprimer une version
    /*$query = "
    DELETE FROM C_impliquer  
    WHERE id_utilisateur = '".$input["id_utilisateur"]."'
    ";
    mysqli_query($connect, $query);*/
    $_SESSION['message_success_5'] = "La version a bien été supprimé de ce groupe !";

}

echo json_encode($input);

?>
