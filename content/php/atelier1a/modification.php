<?php  
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v6");

$input = filter_input_array(INPUT_POST);

$nom = mysqli_real_escape_string($connect, $input["nom"]);
$prenom = mysqli_real_escape_string($connect, $input["prenom"]);
$poste = mysqli_real_escape_string($connect, $input["poste"]);

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

// Verification du prenom
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenom)){
    $results["error"] = true;
    $results["message"]["prenom"] = "Prenom invalide";
    ?>
    <strong style="color:#FF6565;">Prénom invalide </br></strong>
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
    UPDATE utilisateur 
    SET nom = '".$nom."', 
    prenom = '".$prenom."',
    poste = '".$poste."'
    WHERE id_utilisateur = '".$input["id_utilisateur"]."'
    ";

    mysqli_query($connect, $query);
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM utilisateur 
    WHERE id_utilisateur = '".$input["id_utilisateur"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>