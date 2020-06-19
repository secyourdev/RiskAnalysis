<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v8");

$input = filter_input_array(INPUT_POST);

$nom_evenement_redoutes = mysqli_real_escape_string($connect, $input['nom_evenement_redoutes']);
$description_evenement_redoutes = mysqli_real_escape_string($connect, $input['description_evenement_redoutes']);
$impact = mysqli_real_escape_string($connect, $input['impact']);
$niveau_de_gravite = mysqli_real_escape_string($connect, $input['niveau_de_gravite']);

$confidentialite = 0;
$integrite = 0;
$disponibilite = 0;
$tracabilite = 0;

$results["error"] = false;
$results["message"] = [];

// Verification du nom_evenement_redoutes
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_evenement_redoutes)) {
    $results["error"] = true;
    $results["message"]["nom_evenement_redoutes"] = "Nom de l'évenement redouté invalide";
    ?>
    <strong style="color:#FF6565;">nom_evenement_redoutes invalide </br></strong>
    <?php
}


if ($input["action"] === 'edit' && $results["error"] === false) {
    $query = "
    UPDATE evenement_redoutes 
    SET 
    nom_evenement_redoutes = '" . $nom_evenement_redoutes . "',
    description_evenement_redoutes = '" . $description_evenement_redoutes . "',
    impact = '" . $impact . "',
    confidentialite = '" . $confidentialite . "',
    integrite = '" . $integrite . "',
    disponibilite = '" . $disponibilite . "',
    tracabilite = '" . $tracabilite . "',
    niveau_de_gravite = '" . $niveau_de_gravite . "'
    WHERE id_evenement_redoutes = '" . $input["id_evenement_redoutes"] . "'
    ";

    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM evenement_redoutes 
    WHERE id_evenement_redoutes = '".$input["id_evenement_redoutes"]."'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
