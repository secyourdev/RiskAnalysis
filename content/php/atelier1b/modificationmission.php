<?php

session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];;

if ($input["action"] === 'edit') {

    $nom_mission = mysqli_real_escape_string($connect, $input["nom_mission"]);
    $description_mission = mysqli_real_escape_string($connect, $input["description_mission"]);
    $responsable = mysqli_real_escape_string($connect, $input["responsable"]);
    $nom_responsable_vm = mysqli_real_escape_string($connect, $input["nom_responsable_vm"]);
    $nom_responsable_bs = mysqli_real_escape_string($connect, $input["nom_responsable_bs"]);

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
    $query = 
    "UPDATE I_mission 
    SET nom_mission = '" . $nom_mission . "', description_mission = '" . $description_mission . "',
    responsable = '".$responsable."'
    WHERE id_mission = '" . $input["id_mission"] . "'
    AND id_atelier = '" . $id_atelier . "'
    AND id_projet = " . $id_projet . "
    ";

    mysqli_query($connect, $query);

    $query_couple = 
    "UPDATE L_couple_VMBS 
    SET nom_responsable_vm = '" . $nom_responsable_vm . "',
    nom_responsable_bs = '".$nom_responsable_bs."'
    WHERE id_mission = '" . $input["id_mission"] . "'
    ";

    mysqli_query($connect, $query_couple);
    $_SESSION['message_success'] = "La mission a bien été modifiée !";
    }
}

if ($input["action"] === 'delete') {
    $query = 
    "DELETE FROM I_mission 
    WHERE id_mission = '" . $input["id_mission"] . "'
    AND id_atelier = '" . $id_atelier . "'
    AND id_projet = " . $id_projet . "
    ";
    mysqli_query($connect, $query);
    $_SESSION['message_error'] = "La mission a bien été modifiée !";
}

echo json_encode($input);

?>