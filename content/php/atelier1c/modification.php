<?php  
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v5");

$input = filter_input_array(INPUT_POST);

$id_valeur_metier = mysqli_real_escape_string($connect, $input["id_valeur_metier"]);
$nom_evenement_redoutes = mysqli_real_escape_string($connect, $input["nom_evenement_redoutes"]);
$description_evenement_redoutes = mysqli_real_escape_string($connect, $input["description_evenement_redoutes"]);
$impact = mysqli_real_escape_string($connect, $input["impact"]);
$confidentialite = mysqli_real_escape_string($connect, $input["confidentialite"]);
$integrite = mysqli_real_escape_string($connect, $input["integrite"]);
$disponibilite = mysqli_real_escape_string($connect, $input["disponibilite"]);
$tracabilite = mysqli_real_escape_string($connect, $input["tracabilite"]);
$niveau_de_gravite = mysqli_real_escape_string($connect, $input["niveau_de_gravite"]);

$results["error"] = false;
$results["message"] = [];

// Verification du nom
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $id_valeur_metier)){
    $results["error"] = true;
    $results["message"]["id_valeur_metier"] = "Nom invalide";
    ?>
    <strong style="color:#FF6565;">Nom invalide </br></strong>
    <?php
}

// Verification du nom_evenement_redoutes
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_evenement_redoutes)){
    $results["error"] = true;
    $results["message"]["nom_evenement_redoutes"] = "Nom de l'évenement redouté invalide";
    ?>
    <strong style="color:#FF6565;">Prénom invalide </br></strong>
    <?php
}

// Verification du description_evenement_redoutes
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_evenement_redoutes)){
    $results["error"] = true;
    $results["message"]["description_evenement_redoutes"] = "Description de l'événement redouté invalide";
    ?>
    <strong style="color:#FF6565;">Poste invalide </br></strong>
    <?php
}

// Verification du impact
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $impact)){
    $results["error"] = true;
    $results["message"]["impact"] = "impact invalide";
    ?>
    <strong style="color:#FF6565;">Poste invalide </br></strong>
    <?php
}

// Verification du confidentialite
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $confidentialite)){
    $results["error"] = true;
    $results["message"]["confidentialite"] = "confidentialite invalide";
    ?>
    <strong style="color:#FF6565;">Poste invalide </br></strong>
    <?php
}

// Verification du integrite
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $integrite)){
    $results["error"] = true;
    $results["message"]["integrite"] = "integrite invalide";
    ?>
    <strong style="color:#FF6565;">Poste invalide </br></strong>
    <?php
}

// Verification du disponibilite
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $disponibilite)){
    $results["error"] = true;
    $results["message"]["disponibilite"] = "disponibilite invalide";
    ?>
    <strong style="color:#FF6565;">Poste invalide </br></strong>
    <?php
}

// Verification du tracabilite
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $tracabilite)){
    $results["error"] = true;
    $results["message"]["tracabilite"] = "tracabilite invalide";
    ?>
    <strong style="color:#FF6565;">Poste invalide </br></strong>
    <?php
}

// Verification du niveau_de_gravite
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $niveau_de_gravite)){
    $results["error"] = true;
    $results["message"]["niveau_de_gravite"] = "niveau_de_gravite invalide";
    ?>
    <strong style="color:#FF6565;">Poste invalide </br></strong>
    <?php
}

if($input["action"] === 'edit' && $results["error"] === false){
    $query = "
    UPDATE evenement_redoutes 
    SET 
    id_valeur_metier = '".$id_valeur_metier."', 
    nom_evenement_redoutes = '".$nom_evenement_redoutes."',
    description_evenement_redoutes = '".$description_evenement_redoutes."'
    impact = '".$impact."'
    confidentialite = '".$confidentialite."'
    integrite = '".$integrite."'
    disponibilite = '".$disponibilite."'
    tracabilite = '".$tracabilite."'
    niveau_de_gravite = '".$niveau_de_gravite."'
    WHERE id_evenement_redoutes = '".$input["id_evenement_redoutes"]."'
    ";

    mysqli_query($connect, $query);
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM evenement_redoutes 
    WHERE id_evenement_redoutes = '".$input["id_evenement_redoutes"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>