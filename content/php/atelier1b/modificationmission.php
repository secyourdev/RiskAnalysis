<?php  
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v5");

$input = filter_input_array(INPUT_POST);

// $mission = mysqli_real_escape_string($connect, $input["mission"]);
// $nomresponsable = mysqli_real_escape_string($connect, $input["nomresponsable"]);
// $prenomresponsable = mysqli_real_escape_string($connect, $input["prenomresponsable"]);
$poste = mysqli_real_escape_string($connect, $input["poste"]);
$nom = mysqli_real_escape_string($connect, $input["nom"]);
$mission = mysqli_real_escape_string($connect, $input["mission"]);

$results["error"] = false;
$results["message"] = [];

// Verification du nom
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom)){
    $results["error"] = true;
    $results["message"]["nom"] = "Nom invalide";
    ?>
    <strong style="color:#FF6565;">Nom invalide </br></strong>
    <?php
}

// Verification de la mission
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $mission)){
    $results["error"] = true;
    $results["message"]["prenom"] = "Mission invalide";
    ?>
    <strong style="color:#FF6565;">Mission invalide </br></strong>
    <?php
}

// Verification du poste
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste)){
    $results["error"] = true;
    $results["message"]["poste"] = "Poste invalide";
    ?>
    <strong style="color:#FF6565;">Poste invalide </br></strong>
    <?php
}

if($input["action"] === 'edit' && $results["error"] === false){
    $query = "
    UPDATE personne 
    SET nom = '".$nom."', 
    prenom = '".$prenom."',
    poste = '".$poste."'
    WHERE id_personne = '".$input["id_personne"]."'
    ";

    mysqli_query($connect, $query);
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM personne 
    WHERE id_personne = '".$input["id_personne"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>