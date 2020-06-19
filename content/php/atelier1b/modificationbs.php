<?php  
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v6");

$input = filter_input_array(INPUT_POST);

$nom_bien_support = mysqli_real_escape_string($connect, $input["nom_bien_support"]);
$nom_valeur_metier = mysqli_real_escape_string($connect, $input["nom_valeur_metier"]);
$description_bien_support = mysqli_real_escape_string($connect, $input["description_bien_support"]);
$nom_responsable = mysqli_real_escape_string($connect, $input["nom_responsable"]);
$prenom_responsable = mysqli_real_escape_string($connect, $input["prenom_responsable"]);
$poste_responsable = mysqli_real_escape_string($connect, $input["poste_responsable"]);


$results["error"] = false;
$results["message"] = [];

// Verification du nom du bien support
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_bien_support)){
    $results["error"] = true;
    $results["message"]["nom"] = "Nom invalide";
    ?>
    <strong style="color:#FF6565;">Nom invalide </br></strong>
    <?php
}

// Verification de la description
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_bien_support)){
    $results["error"] = true;
    $results["message"]["prenom"] = "Description invalide";
    ?>
    <strong style="color:#FF6565;">Description invalide </br></strong>
    <?php
}

// Verification du nom du responsable
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_responsable)){
    $results["error"] = true;
    $results["message"]["poste"] = "Nom invalide";
    ?>
    <strong style="color:#FF6565;">Nom invalide </br></strong>
    <?php
}

// Verification du prenom du responsable
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenom_responsable)){
    $results["error"] = true;
    $results["message"]["poste"] = "Prenom invalide";
    ?>
    <strong style="color:#FF6565;">Prenom invalide </br></strong>
    <?php
}

// Verification du nom du responsable
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste_responsable)){
    $results["error"] = true;
    $results["message"]["poste"] = "Poste invalide";
    ?>
    <strong style="color:#FF6565;">Poste invalide </br></strong>
    <?php
}


if($input["action"] === 'edit' && $results["error"] === false){
    $queryp = "
    UPDATE personne
    SET nom = '".$nom_responsable."',
    prenom = '".$prenom_responsable."',
    poste = '".$poste_responsable."'
    WHERE id_personne = (SELECT id_personne FROM bien_support WHERE id_bien_support = '".$input["id_bien_support"]."')
    ";
    
    $querybs = "
    UPDATE bien_support 
    SET nom_bien_support = '".$nom_bien_support."', 
    description_bien_support = '".$description_bien_support."',
    id_valeur_metier = (SELECT id_valeur_metier FROM valeur_metier WHERE nom_valeur_metier = '".$nom_valeur_metier."')
    WHERE id_bien_support = '".$input["id_bien_support"]."'
    ";
    mysqli_query($connect, $queryp);
    mysqli_query($connect, $querybs);
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM bien_support 
    WHERE id_bien_support = '".$input["id_bien_support"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>