<?php
include("content/php/bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$motivation = mysqli_real_escape_string($connect, $input['motivation']);
$ressources = mysqli_real_escape_string($connect, $input['ressources']);
$activite = mysqli_real_escape_string($connect, $input['activite']);
if ($input['mode_operatoire'] !== null){
    $mode_operatoire = mysqli_real_escape_string($connect, $input['mode_operatoire']);
}else{
    $mode_operatoire = '';
}
if ($input['secteur_d_activite'] !== null) {
    $secteur_activite = mysqli_real_escape_string($connect, $input['secteur_d_activite']);
}else{
     $secteur_activite = '';
}
if ($input['arsenal_d_attaque'] !== null) {
    $arsenal_attaque = mysqli_real_escape_string($connect, $input['arsenal_d_attaque']);
}else{
    $arsenal_attaque = '';
}
if ($input['faits_d_armes'] !== null) {
    $faits_armes = mysqli_real_escape_string($connect, $input['faits_d_armes']);
}else{
    $faits_armes = '';
}

$pertinence = mysqli_real_escape_string($connect, $input['pertinence']);
$choix_sr = NULL;

$results["error"] = false;

// Verification du mode opératoire
if (!preg_match("/^$|^[a-zA-Z0-9éèàêâôùïüëç'\s-]{1,100}$/", $mode_operatoire)) {
    $results["error"] = true;
    print "error";
}

// Verification du secteur d'activité
if (!preg_match("/^$|^[a-zA-Z0-9éèàêâôùïüëç'\s-]{1,100}$/", $secteur_activite)) {
    $results["error"] = true;
    print "error";
}

// Verification de l'arsenal d'attaque'
if (!preg_match("/^$|^[a-zA-Z0-9éèàêâôùïüëç'\s-]{1,100}$/", $arsenal_attaque)) {
    $results["error"] = true;
    print "error";
}

// Verification des afaits d'armes
if (!preg_match("/^$|^[a-zA-Z0-9éèàêâôùïüëç'\s-]{1,100}$/", $faits_armes)) {
    $results["error"] = true;
    print "error";
}
// Verification des afaits d'armes
if (!preg_match("/^[1-3]$/", $motivation)) {
    $results["error"] = true;
    print "error";
}
// Verification des afaits d'armes
if (!preg_match("/^[1-3]$/", $ressources)) {
    $results["error"] = true;
    print "error";
}
// Verification des afaits d'armes
if (!preg_match("/^[1-3]$/", $activite)) {
    $results["error"] = true;
    print "error";
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
