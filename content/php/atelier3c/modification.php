<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");

$input = filter_input_array(INPUT_POST);


$nom_mesure_securite = mysqli_real_escape_string($connect, $input['nom_mesure_securite']);
$description_mesure_securite = mysqli_real_escape_string($connect, $input['description_mesure_securite']);

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
    UPDATE mesure 
    SET 
    nom_mesure = '" . $nom_mesure_securite . "',
    description_mesure = '" . $description_mesure_securite . "',
    WHERE id_mesure = '" . $input["id_mesure"] . "'
    ";

    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM partie_prenante 
    WHERE id_partie_prenante = '".$input["id_partie_prenante"]."'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
