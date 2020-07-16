<?php
//action.php
session_start();
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");

$input = filter_input_array(INPUT_POST);

$type_attaquant = mysqli_real_escape_string($connect, $input['type_d_attaquant_source_de_risque']);
$profil_attaquant = mysqli_real_escape_string($connect, $input['profil_de_l_attaquant_source_de_risque']);
$description_source_risque = mysqli_real_escape_string($connect, $input['description_source_de_risque']);
$objectif_vise = mysqli_real_escape_string($connect, $input['objectif_vise']);
$description_objectif_vise = mysqli_real_escape_string($connect, $input['description_objectif_vise']);
$id_projet =  $_SESSION['id_projet'];


$results["error"] = false;
$results["message"] = [];





// Verification du type de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $type_attaquant)) {
    $results["error"] = true;
    $results["message"]["type_attaquant"] = "Type de l'attaquant invalide";
    ?>
    <strong style="color:#FF6565;">Type de l'attaquant invalide </br></strong>
    <?php
}

// Verification du profil de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $profil_attaquant)) {
    $results["error"] = true;
    $results["message"]["Profil de l'attaquant"] = "Profil de l'attaquant invalide";
    ?>
    <strong style="color:#FF6565;">Profil de l'attaquant invalide </br></strong>
    <?php
}

// Verification de la description de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_source_risque)) {
    $results["error"] = true;
    $results["message"]["impact"] = "Description de la source de risque invalide";
    ?>
    <strong style="color:#FF6565;">Description de la source de risque invalide </br></strong>
    <?php
}
// Verification de l'objectif visé
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $objectif_vise)) {
    $results["error"] = true;
    $results["message"]["objectif vise"] = "Objectif vise invalide";
    ?>
    <strong style="color:#FF6565;">Objectif visé invalide </br></strong>
    <?php
}

// Verification de la description de l'objectif visé
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $description_objectif_vise)) {
    $results["error"] = true;
    $results["message"]["description objectif vise"] = "Description objectif vise invalide";
    ?>
    <strong style="color:#FF6565;">Descrition objectif visé invalide </br></strong>
    <?php
}

if ($input["action"] === 'edit' && $results["error"] === false) {
    
    $query = "
    UPDATE SROV 
    SET type_d_attaquant_source_de_risque = '".$type_attaquant."',
    profil_de_l_attaquant_source_de_risque = '".$profil_attaquant."',
    description_source_de_risque = '".$description_source_risque."',
    objectif_vise = '".$objectif_vise."',
    description_objectif_vise = '".$description_objectif_vise."'
    WHERE id_source_de_risque = '".$input["id_source_de_risque"]."'
    AND id_projet = '".$id_projet."'
    ";
    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM SROV 
    WHERE id_source_de_risque = '".$input["id_source_de_risque"]."'
    ";
    echo $query;
    mysqli_query($connect, $query);
}


echo json_encode($input);
