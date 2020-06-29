<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v9");

$input = filter_input_array(INPUT_POST);

$nom_evenement_redoutes = mysqli_real_escape_string($connect, $input['nom_evenement_redoute']);
$description_evenement_redoutes = mysqli_real_escape_string($connect, $input['description_evenement_redoute']);
$impact = mysqli_real_escape_string($connect, $input['impact']);
$niveau_de_gravite = mysqli_real_escape_string($connect, $input['niveau_de_gravite']);

$confidentialite = 0;
$integrite = 0;
$disponibilite = 0;
$tracabilite = 0;

$results["error"] = false;
$results["message"] = [];




$cleanArray = [];
foreach ($_POST['cidt'] as $val)
    $cleanArray[] = mysqli_real_escape_string($connect, $val);

if (in_array('a0', $cleanArray)) {
    //do somthing ...
    $confidentialite = 1;
};
if (in_array('a1', $cleanArray)) {
    //do somthing ...
    $integrite = 1;
};
if (in_array('a2', $cleanArray)) {
    //do somthing ...
    $disponibilite = 1;
};
if (in_array('a3', $cleanArray)) {
    //do somthing ...
    $tracabilite = 1;
};




// Verification du nom_evenement_redoutes
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_evenement_redoutes)) {
    $results["error"] = true;
    $results["message"]["nom_evenement_redoute"] = "Nom de l'évenement redouté invalide";
    ?>
    <strong style="color:#FF6565;">nom_evenement_redoutes invalide </br></strong>
    <?php
}

// Verification du description_evenement_redoutes
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $description_evenement_redoutes)) {
    $results["error"] = true;
    $results["message"]["description_evenement_redoute"] = "Description de l'événement redouté invalide";
    ?>
    <strong style="color:#FF6565;">description_evenement_redoutes invalide </br></strong>
    <?php
}

// Verification du impact
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $impact)) {
    $results["error"] = true;
    $results["message"]["impact"] = "impact invalide";
    ?>
    <strong style="color:#FF6565;">impact invalide </br></strong>
    <?php
}
// Verification du niveau_de_gravite
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $niveau_de_gravite)) {
    $results["error"] = true;
    $results["message"]["niveau_de_gravite"] = "niveau_de_gravite invalide";
    ?>
    <strong style="color:#FF6565;">niveau_de_gravite invalide </br></strong>
    <?php
}

if ($input["action"] === 'edit' && $results["error"] === false) {
    $query = "
    UPDATE evenement_redoute 
    SET 
    nom_evenement_redoute = '" . $nom_evenement_redoutes . "',
    description_evenement_redoute = '" . $description_evenement_redoutes . "',
    impact = '" . $impact . "',
    confidentialite = '" . $confidentialite . "',
    integrite = '" . $integrite . "',
    disponibilite = '" . $disponibilite . "',
    tracabilite = '" . $tracabilite . "',
    niveau_de_gravite = '" . $niveau_de_gravite . "'
    WHERE id_evenement_redoute = '" . $input["id_evenement_redoute"] . "'
    ";

    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM evenement_redoute 
    WHERE id_evenement_redoute = '".$input["id_evenement_redoute"]."'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
