<?php  
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v6");

$input = filter_input_array(INPUT_POST);

$nom_valeur_metier = mysqli_real_escape_string($connect, $input["nom_valeur_metier"]);
$nom_mission = mysqli_real_escape_string($connect, $input["mission"]);
$nature_valeur_metier = mysqli_real_escape_string($connect, $input["nature_valeur_metier"]);
$description_valeur_metier = mysqli_real_escape_string($connect, $input["description_valeur_metier"]);
$nom_responsable = mysqli_real_escape_string($connect, $input["nom_responsable"]);
$prenom_responsable = mysqli_real_escape_string($connect, $input["prenom_responsable"]);
$poste_responsable = mysqli_real_escape_string($connect, $input["poste_responsable"]);


$results["error"] = false;
$results["message"] = [];

// Verification du nom de la valeur metier
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)){
    $results["error"] = true;
    $results["message"]["nom"] = "Nom de valeur métier invalide";
    ?>
    <strong style="color:#FF6565;">Nom de valeur métier invalide </br></strong>
    <?php
}

// Verification de la descripion
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_valeur_metier)){
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
    $results["message"]["poste"] = "Nom invalide";
    ?>
    <strong style="color:#FF6565;">Prénom invalide </br></strong>
    <?php
}

// Verification du poste du responsable
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste_responsable)){
    $results["error"] = true;
    $results["message"]["poste"] = "Nom invalide";
    ?>
    <strong style="color:#FF6565;">Poste invalide </br></strong>
    <?php
}
echo($results["error"]);
echo($input["action"]);
if($input["action"] === 'edit' && $results["error"] === false){
    $queryp = "
    UPDATE personne
    SET nom = '".$nom_responsable."',
    prenom = '".$prenom_responsable."',
    poste = '".$poste_responsable."'
    WHERE id_personne = (SELECT id_personne FROM valeur_metier WHERE id_valeur_metier = '".$input["id_valeur_metier"]."')
    ";
    
    $queryvm = "
    UPDATE valeur_metier 
    SET nom_valeur_metier = '".$nom_valeur_metier."', 
    nature_valeur_metier = '".$nature_valeur_metier."',
    description_valeur_metier = '".$description_valeur_metier."',
    id_mission = (SELECT id_mission FROM mission WHERE nom_mission = '".$nom_mission."')
    WHERE id_valeur_metier = '".$input["id_valeur_metier"]."'
    ";
    mysqli_query($connect, $queryp);
    mysqli_query($connect, $queryvm);
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM valeur_metier 
    WHERE id_valeur_metier = '".$input["id_valeur_metier"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>