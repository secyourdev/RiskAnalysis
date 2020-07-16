<?php  
//action.php
session_start();
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v18");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];;

if($input["action"] === 'edit'){
    $nom_valeur_metier = mysqli_real_escape_string($connect, $input["nom_valeur_metier"]);
    $nature_valeur_metier = mysqli_real_escape_string($connect, $input["nature_valeur_metier"]);
    $description_valeur_metier = mysqli_real_escape_string($connect, $input["description_valeur_metier"]);

    // Verification du nom de la valeur métier
    if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)) {
      $results["error"] = true;
    }

    // Verification de la description de la valeur métier
    if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $description_valeur_metier)) {
      $results["error"] = true;
    }

    // Verification de la nature de la valeur métier
    if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nature_valeur_metier)) {
      $results["error"] = true;
    }

    if($results["error"] === false){
      $queryvm = 
      "UPDATE valeur_metier 
      SET nom_valeur_metier = '".$nom_valeur_metier."', 
      nature_valeur_metier = '".$nature_valeur_metier."',
      description_valeur_metier = '".$description_valeur_metier."'
      WHERE id_valeur_metier = '".$input["id_valeur_metier"]. "'
      AND id_atelier = '" . $id_atelier . "'
      AND id_projet = " . $id_projet . "
      ";

      mysqli_query($connect, $queryvm);
    }
}

if($input["action"] === 'delete'){
    $query = 
    "DELETE FROM valeur_metier 
    WHERE id_valeur_metier = '".$input["id_valeur_metier"]. "'
    AND id_atelier = '" . $id_atelier . "'
    AND id_projet = " . $id_projet . "
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>