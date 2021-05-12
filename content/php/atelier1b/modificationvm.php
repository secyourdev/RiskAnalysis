<?php  

session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];;

if($input["action"] === 'edit'){
    $nom_valeur_metier = $_POST["nom_valeur_metier"];
    $nature_valeur_metier = $_POST["nature_valeur_metier"];
    $description_valeur_metier = $_POST["description_valeur_metier"];

    // Verification du nom de la valeur métier
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_valeur_metier)) {
      $results["error"] = true;
      $_SESSION['message_error_2'] = "Nom invalide";
    }

    // Verification de la description de la valeur métier
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $description_valeur_metier)) {
      $results["error"] = true;
      $_SESSION['message_error_2'] = "Description invalide";
    }

    // Verification de la nature de la valeur métier
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nature_valeur_metier)) {
      $results["error"] = true;
      $_SESSION['message_error_2'] = "Nature invalide";
    }

    if($results["error"] === false){
      $update = $bdd->prepare("UPDATE `J_valeur_metier` SET `nom_valeur_metier`=?, `nature_valeur_metier`=?, `description_valeur_metier`=? WHERE `id_valeur_metier`=? AND `id_atelier`=? AND `id_projet`=?");
      $update->bindParam(1, $nom_valeur_metier);
      $update->bindParam(2, $nature_valeur_metier);
      $update->bindParam(3, $description_valeur_metier);
      $update->bindParam(4, $input["id_valeur_metier"]);
      $update->bindParam(5, $id_atelier);
      $update->bindParam(6, $id_projet);
      $update->execute();

      $_SESSION['message_success_2'] = "La valeur métier a bien été modifiée !";
    }
}

if($input["action"] === 'delete'){
    $delete = $bdd->prepare("DELETE FROM `J_valeur_metier` WHERE `id_valeur_metier`=? AND `id_atelier`=?  AND `id_projet`=? ");
    $delete->bindParam(1, $input["id_valeur_metier"]);
    $delete->bindParam(2, $id_atelier);
    $delete->bindParam(3, $id_projet);
    $delete->execute();

    $_SESSION['message_success_2'] = "La valeur métier a bien été supprimée !";
}

echo json_encode($input);

?>