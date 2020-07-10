<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v18");

$input = filter_input_array(INPUT_POST);

// $profil_attaquant = mysqli_real_escape_string($connect, $input['profil_de_l_attaquant_source_de_risque']);
// $description_source_risque = mysqli_real_escape_string($connect, $input['description_source_de_risque']);
// $objectif_vise = mysqli_real_escape_string($connect, $input['objectif_vise']);
// $description_objectif_vise = mysqli_real_escape_string($connect, $input['description_objectif_vise']);
// $motivation = mysqli_real_escape_string($connect, $input['motivation']);
// $ressources = mysqli_real_escape_string($connect, $input['ressources']);
// $activite = mysqli_real_escape_string($connect, $input['activite']);
// $mode_operatoire = mysqli_real_escape_string($connect, $input['mode_operatoire']);
// $secteur_activite = mysqli_real_escape_string($connect, $input['secteur_d_activite']);
// $arsenal_attaque = mysqli_real_escape_string($connect, $input['arsenal_d_attaque']);
// $faits_armes = mysqli_real_escape_string($connect, $input['faits_d_armes']);
// $pertinence = mysqli_real_escape_string($connect, $input['pertinence']);
$choix_sr = mysqli_real_escape_string($connect, $input['choix_source_de_risque']);



$results["error"] = false;
$results["message"] = [];



if ($input["action"] === 'edit' && $results["error"] === false) {

    $query = "
    UPDATE SROV 
    SET choix_source_de_risque = '".$choix_sr."'
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
