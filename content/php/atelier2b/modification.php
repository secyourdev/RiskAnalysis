<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v17");

$input = filter_input_array(INPUT_POST);

// $profil_attaquant = mysqli_real_escape_string($connect, $input['profil_de_l_attaquant_source_de_risque']);
// $description_source_risque = mysqli_real_escape_string($connect, $input['description_source_de_risque']);
// $objectif_vise = mysqli_real_escape_string($connect, $input['objectif_vise']);
// $description_objectif_vise = mysqli_real_escape_string($connect, $input['description_objectif_vise']);
$motivation = mysqli_real_escape_string($connect, $input['motivation']);
$ressources = mysqli_real_escape_string($connect, $input['ressources']);
$activite = mysqli_real_escape_string($connect, $input['activite']);
$mode_operatoire = mysqli_real_escape_string($connect, $input['mode_operatoire']);
$secteur_activite = mysqli_real_escape_string($connect, $input['secteur_d_activite']);
$arsenal_attaque = mysqli_real_escape_string($connect, $input['arsenal_d_attaque']);
$faits_armes = mysqli_real_escape_string($connect, $input['faits_d_armes']);
$pertinence = mysqli_real_escape_string($connect, $input['pertinence']);
$choix_sr = NULL;


$results["error"] = false;
$results["message"] = [];






// Verification du mode opératoire
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $mode_operatoire)) {
    $results["error"] = true;
    $results["message"]["description objectif vise"] = "Mode opératoire invalide";
    ?>
    <strong style="color:#FF6565;">Mode opératoire invalide </br></strong>
    <?php
}

// Verification du secteur d'activité
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $secteur_activite)) {
    $results["error"] = true;
    $results["message"]["description objectif vise"] = "Secteur d'activité invalide";
    ?>
    <strong style="color:#FF6565;">Secteur d'activité invalide </br></strong>
    <?php
}

// Verification de l'arsenal d'attaque'
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $arsenal_attaque)) {
    $results["error"] = true;
    $results["message"]["description objectif vise"] = "Arsenal d'attaque invalide";
    ?>
    <strong style="color:#FF6565;">Arsenal d'attaque invalide </br></strong>
    <?php
}

// Verification des afaits d'armes
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $faits_armes)) {
    $results["error"] = true;
    $results["message"]["description objectif vise"] = "Faits d'armes invalide";
    ?>
    <strong style="color:#FF6565;">Faits d'armes invalide </br></strong>
    <?php
}

if ($input["action"] === 'edit' && $results["error"] === false) {

    if ($pertinence === "Auto"){
        echo $ressources;
        echo $motivation;
        if (($ressources === "1" && $motivation === "1") || ($ressources === "1" && $motivation === "2") || ($ressources === "2" && $motivation === "1")) {
            $pertinence = "Faible";
            echo "Faible";
        }
        elseif (($ressources === "3" && $motivation === "1") || ($ressources === "2" && $motivation === "2") || ($ressources === "1" && $motivation === "3")) {
            $pertinence = "Moyen";
            echo "Moyen";
        }
        else {
            $pertinence = "Elevé";
            echo "Elevé";
        }
    }
    
    $query = "
    UPDATE SROV 
    SET motivation = '".$motivation."',
    ressources = '".$ressources."',
    activite = '".$activite."',
    mode_operatoire = '".$mode_operatoire."',
    secteur_d_activite = '".$secteur_activite."',
    arsenal_d_attaque = '".$arsenal_attaque."',
    faits_d_armes = '".$faits_armes."',
    pertinence = '".$pertinence."',
    choix_source_de_risque = '".$choix_sr."'
    WHERE id_source_de_risque = '".$input["id_source_de_risque"]."'
    ";
    echo $query;
    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM SROV 
    WHERE id_source_de_risque = '".$input["id_source_de_risque"]."'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
