<?php  

session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];;

if($input["action"] === 'edit'){
    $nom_valeur_metier = mysqli_real_escape_string($connect, $input["nom_valeur_metier"]);
    $nature_valeur_metier = mysqli_real_escape_string($connect, $input["nature_valeur_metier"]);
    $description_valeur_metier = mysqli_real_escape_string($connect, $input["description_valeur_metier"]);

    // Verification du nom de la valeur métier
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $nom_valeur_metier)) {
      $results["error"] = true;
      $_SESSION['message_error_2'] = "Nom invalide";
    }

    // Verification de la description de la valeur métier
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,1000}$/", $description_valeur_metier)) {
      $results["error"] = true;
      $_SESSION['message_error_2'] = "Description invalide";
    }

    // Verification de la nature de la valeur métier
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $nature_valeur_metier)) {
      $results["error"] = true;
      $_SESSION['message_error_2'] = "Nature invalide";
    }

    if($results["error"] === false){
      $queryvm = 
      "UPDATE J_valeur_metier 
      SET nom_valeur_metier = '".$nom_valeur_metier."', 
      nature_valeur_metier = '".$nature_valeur_metier."',
      description_valeur_metier = '".$description_valeur_metier."'
      WHERE id_valeur_metier = '".$input["id_valeur_metier"]. "'
      AND id_atelier = '" . $id_atelier . "'
      AND id_projet = " . $id_projet . "
      ";

      mysqli_query($connect, $queryvm);
      $_SESSION['message_success_2'] = "La valeur métier a bien été modifiée !";
    }
}

if($input["action"] === 'delete'){
    $query = 
    "DELETE FROM J_valeur_metier 
    WHERE id_valeur_metier = '".$input["id_valeur_metier"]. "'
    AND id_atelier = '" . $id_atelier . "'
    AND id_projet = " . $id_projet . "
    ";
    mysqli_query($connect, $query);
    $_SESSION['message_success_2'] = "La valeur métier a bien été supprimée !";
}

echo json_encode($input);

?>