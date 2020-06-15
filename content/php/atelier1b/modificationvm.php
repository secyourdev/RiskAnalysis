<?php  
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v5");

$input = filter_input_array(INPUT_POST);

$nom_valeur_metier = mysqli_real_escape_string($connect, $input["nom_valeur_metier"]);
$nature_valeur_metier = mysqli_real_escape_string($connect, $input["nature_valeur_metier"]);
$description_valeur_metier = mysqli_real_escape_string($connect, $input["description_valeur_metier"]);
$nom = mysqli_real_escape_string($connect, $input["nom"]);

$results["error"] = false;
$results["message"] = [];

// Verification du nom
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)){
    $results["error"] = true;
    $results["message"]["nom"] = "Nom de valeur métier invalide";
    ?>
    <strong style="color:#FF6565;">Nom de valeur métier invalide </br></strong>
    <?php
}

// Verification du prenom
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_valeur_metier)){
    $results["error"] = true;
    $results["message"]["prenom"] = "Description invalide";
    ?>
    <strong style="color:#FF6565;">Description invalide </br></strong>
    <?php
}

// Verification du poste
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom)){
    $results["error"] = true;
    $results["message"]["poste"] = "Nom invalide";
    ?>
    <strong style="color:#FF6565;">Nom invalide </br></strong>
    <?php
}

if($input["action"] === 'edit' && $results["error"] === false){
    $queryp = "
    UPDATE personne
    SET nom = '".$nom."'
    WHERE id_personne = (SELECT id_personne FROM valeur_metier WHERE id_valeur_metier = '".$input["id_valeur_metier"]."')
    ";
    
    $queryvm = "
    UPDATE valeur_metier 
    SET nom_valeur_metier = '".$nom_valeur_metier."', 
    nature_valeur_metier = '".$nature_valeur_metier."',
    description_valeur_metier = '".$description_valeur_metier."',
    
    WHERE id_valeur_metier = '".$input["id_valeur_metier"]."'
    ";

    mysqli_query($connect, $queryvm);
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