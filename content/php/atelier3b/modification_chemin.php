<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v9");

$input = filter_input_array(INPUT_POST);

$chemin_d_attaque_strategique = mysqli_real_escape_string($connect, $input['chemin_d_attaque_strategique']);
$dependance_residuelle = mysqli_real_escape_string($connect, $input['dependance_residuelle']);
$penetration_residuelle = mysqli_real_escape_string($connect, $input['penetration_residuelle']);
$maturite_residuelle = mysqli_real_escape_string($connect, $input['maturite_residuelle']);
$confiance_residuelle = mysqli_real_escape_string($connect, $input['confiance_residuelle']);
$niveau_de_menance_residuelle = mysqli_real_escape_string($connect, $input['niveau_de_menance_residuelle']);

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
    UPDATE chemin_d_attaque_strategique 
    SET 
    chemin_d_attaque_strategique = '" . $chemin_d_attaque_strategique . "',
    dependance_residuelle = '" . $dependance_residuelle . "',
    penetration_residuelle = '" . $penetration_residuelle . "',
    maturite_residuelle = '" . $maturite_residuelle . "',
    confiance_residuelle = '" . $confiance_residuelle . "',
    niveau_de_menance_residuelle = '" . $niveau_de_menance_residuelle . "'
    WHERE id_chemin_d_attaque_strategique = '" . $input["id_chemin_d_attaque_strategique"] . "'
    ";
    echo $query;

    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM partie_prenante 
    WHERE id_chemin_d_attaque_strategique = '".$input["id_chemin_d_attaque_strategique"]."'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
