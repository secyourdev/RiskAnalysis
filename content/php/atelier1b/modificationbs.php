<?php  
session_start();

include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];;

if($input["action"] === 'edit'){
    $nom_bien_support =  $_POST["nom_bien_support"];
    $description_bien_support =  $_POST["description_bien_support"];

    // Verification du nom du bien support
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_bien_support)){
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Nom invalide";
    }

    // Verification de la description
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $description_bien_support)){
        $results["error"] = true;
        $_SESSION['message_error_3'] = "Description invalide";
    }

    if($results["error"] === false){
        $update = $bdd->prepare("UPDATE `K_bien_support` SET `nom_bien_support`=?, `description_bien_support`=? WHERE `id_bien_support`=? AND `id_atelier`=? AND `id_projet`=?");
        $update->bindParam(1, $nom_bien_support);
        $update->bindParam(2, $description_bien_support);
        $update->bindParam(3, $input["id_bien_support"]);
        $update->bindParam(4, $id_atelier);
        $update->bindParam(5, $id_projet);
        $update->execute();


        $_SESSION['message_success_3'] = "Le bien support a bien été modifié !";
    }
}

if($input["action"] === 'delete'){
    $delete = $bdd->prepare("DELETE FROM `K_bien_support` WHERE `id_bien_support`=? AND `id_atelier`=? AND `id_projet`=?");
    $delete->bindParam(1, $input["id_bien_support"]);
    $delete->bindParam(2, $id_atelier);
    $delete->bindParam(3, $id_projet);
    $delete->execute();

    $_SESSION['message_success_3'] = "Le bien support a bien été supprimé !";
}

echo json_encode($input);

?>