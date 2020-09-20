<?php

session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];

if ($input["action"] === 'edit') {

    $nom_mission = $_POST["nom_mission"];
    $description_mission = $_POST["description_mission"];
    $responsable = $_POST["responsable"];
    $nom_responsable_vm = $_POST["nom_responsable_vm"];
    $nom_responsable_bs = $_POST["nom_responsable_bs"];

    // Verification de la mission
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_mission)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Nom invalide";
    }

    // Verification de la description de la mission
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $description_mission)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Description mission invalide";
    }

    // Verification du responsable de la mission
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $responsable)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Responsable mission invalide";
    }

    // Verification du responsable de la valeur métier
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_responsable_vm)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Responsable valeur métier invalide";
    }

    // Verification du responsable du bien support
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_responsable_bs)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Nom bien support invalide";
    }

    if($results["error"] === false){
    $update = $bdd->prepare("UPDATE `I_mission` SET `nom_mission`=?, `description_mission`=?, `responsable`=? WHERE `id_mission`=? AND `id_atelier`=? AND `id_projet`=?");
    $update->bindParam(1, $nom_mission);
    $update->bindParam(2, $description_mission);
    $update->bindParam(3, $responsable);
    $update->bindParam(4, $input["id_mission"]);
    $update->bindParam(5, $id_atelier);
    $update->bindParam(6, $id_projet);
    $update->execute();


    $update = $bdd->prepare("UPDATE `L_couple_VMBS` SET `nom_responsable_vm`=?, `nom_responsable_bs`=? WHERE `id_mission`=?");
    $update->bindParam(1, $nom_responsable_vm);
    $update->bindParam(2, $nom_responsable_bs);
    $update->bindParam(3, $input["id_mission"]);
    $update->execute();

    $_SESSION['message_success'] = "La mission a bien été modifiée !";
    }
}

if ($input["action"] === 'delete') {
    $delete = $bdd->prepare("DELETE FROM `I_mission` WHERE `id_mission`=? AND `id_atelier`=? AND `id_projet`=?");
    $delete->bindParam(1, $input["id_mission"]);
    $delete->bindParam(2, $id_atelier);
    $delete->bindParam(3, $id_projet);
    $delete->execute();

    $_SESSION['message_success'] = "La mission a bien été modifiée !";
}

echo json_encode($input);

?>