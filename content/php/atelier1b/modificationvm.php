<?php  
//action.php
session_start();
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v19");

$input = filter_input_array(INPUT_POST);

$nom_valeur_metier = mysqli_real_escape_string($connect, $input["nom_valeur_metier"]);
$nature_valeur_metier = mysqli_real_escape_string($connect, $input["nature_valeur_metier"]);
$description_valeur_metier = mysqli_real_escape_string($connect, $input["description_valeur_metier"]);

$results["error"] = false;
$results["message"] = [];

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];;

// Verification du nom de la valeur métier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nomvm)) {
    $results["error"] = true;
    $results["message"]["nom"] = "Nom invalide";
  ?>
    <strong style="color:#FF6565;">Nom invalide </br></strong>
  <?php
  }
  
  // Verification de la description de la valeur métier
  if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $descriptionvm)) {
    $results["error"] = true;
    $results["message"]["description"] = "Description invalide";
  ?>
    <strong style="color:#FF6565;">Description invalide </br></strong>
  <?php
  }
  
  // Verification de la nature de la valeur métier
  if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nature)) {
    $results["error"] = true;
    $results["message"]["nature"] = "Nature invalide";
  ?>
    <strong style="color:#FF6565;">Nature invalide </br></strong>
  <?php
  }

if($input["action"] === 'edit' && $results["error"] === false){
    
    $queryvm = 
    "UPDATE valeur_metier 
    SET nom_valeur_metier = '".$nom_valeur_metier."', 
    nature_valeur_metier = '".$nature_valeur_metier."',
    description_valeur_metier = '".$description_valeur_metier."'
    WHERE id_valeur_metier = '".$input["id_valeur_metier"]. "'
    AND id_atelier = '" . $id_atelier . "'
    AND id_projet = " . $id_projet . "
    ";

    echo $queryvm;
    mysqli_query($connect, $queryvm);
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