<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v17");

$input = filter_input_array(INPUT_POST);


$categorie_partie_prenante = mysqli_real_escape_string($connect, $input['categorie_partie_prenante']);
$nom_partie_prenante = mysqli_real_escape_string($connect, $input['nom_partie_prenante']);
$type = mysqli_real_escape_string($connect, $input['type']);
$dependance_partie_prenante = mysqli_real_escape_string($connect, $input['dependance_partie_prenante']);
$penetration_partie_prenante = mysqli_real_escape_string($connect, $input['penetration_partie_prenante']);
$maturite_partie_prenante = mysqli_real_escape_string($connect, $input['maturite_partie_prenante']);
$confiance_partie_prenante = mysqli_real_escape_string($connect, $input['confiance_partie_prenante']);
$niveau_de_menace_partie_prenante = ($dependance_partie_prenante * $penetration_partie_prenante) / ($maturite_partie_prenante * $confiance_partie_prenante);

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
    UPDATE partie_prenante 
    SET 
    categorie_partie_prenante = '" . $categorie_partie_prenante . "',
    nom_partie_prenante = '" . $nom_partie_prenante . "',
    type = '" . $type . "',
    dependance_partie_prenante = '" . $dependance_partie_prenante . "',
    penetration_partie_prenante = '" . $penetration_partie_prenante . "',
    maturite_partie_prenante = '" . $maturite_partie_prenante . "',
    confiance_partie_prenante = '" . $confiance_partie_prenante . "',
    niveau_de_menace_partie_prenante = '" . $niveau_de_menace_partie_prenante . "'
    WHERE id_partie_prenante = '" . $input["id_partie_prenante"] . "'
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
