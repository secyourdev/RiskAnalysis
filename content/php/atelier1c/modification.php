<?php  
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v5");

$input = filter_input_array(INPUT_POST);

$nom = mysqli_real_escape_string($connect, $input["nom_evenement_redoutes"]);
$prenom = mysqli_real_escape_string($connect, $input["description_evenement_redoutes"]);
$poste = mysqli_real_escape_string($connect, $input["impact"]);

$results["error"] = false;
$results["message"] = [];

// Verification du nom er
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom)){
    $results["error"] = true;
    $results["message"]["nom"] = "Nom invalide";
    ?>
    <strong style="color:#FF6565;">Nom de l'événement redouté invalide </br></strong>
    <?php
}

// Verification de la description er
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenom)){
    $results["error"] = true;
    $results["message"]["prenom"] = "Description invalide";
    ?>
    <strong style="color:#FF6565;">Description de l'événement redouté invalide </br></strong>
    <?php
}

// Verification de l'impact
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste)){
    $results["error"] = true;
    $results["message"]["poste"] = "Impact invalide";
    ?>
    <strong style="color:#FF6565;">Impact invalide </br></strong>
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