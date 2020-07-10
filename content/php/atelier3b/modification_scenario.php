<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v17");

$input = filter_input_array(INPUT_POST);


$nom_scenario_strategique = mysqli_real_escape_string($connect, $input['nom_scenario_strategique']);

$results["error"] = false;
$results["message"] = [];


/*
// Verification du nom_evenement_redoutes
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_evenement_redoutes)) {
    $results["error"] = true;
    $results["message"]["nom_evenement_redoutes"] = "Nom de l'évenement redouté invalide";
    ?>
    <strong style="color:#FF6565;">nom_evenement_redoutes invalide </br></strong>
    <?php
} */


if ($input["action"] === 'edit' && $results["error"] === false) {
    $query = "
    UPDATE scenario_strategique 
    SET 
    nom_scenario_strategique = '" . $nom_scenario_strategique . "'
    WHERE id_scenario_strategique = '" . $input["id_scenario_strategique"] . "'
    ";
    echo $query;

    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM scenario_strategique 
    WHERE id_scenario_strategique = '".$input["id_scenario_strategique"]."'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
