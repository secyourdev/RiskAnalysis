<?php
include("../bdd/connexion_sqli.php");
// $getid_projet = $_SESSION['id_projet'];
$input = filter_input_array(INPUT_POST);

$nom_mesure_securite = mysqli_real_escape_string($connect, $input['nom_mesure_securite']);
$description_mesure_securite = mysqli_real_escape_string($connect, $input['description_mesure_securite']);
$dependance_residuelle = mysqli_real_escape_string($connect, $input['dependance_residuelle']);
$penetration_residuelle = mysqli_real_escape_string($connect, $input['penetration_residuelle']);
$maturite_residuelle = mysqli_real_escape_string($connect, $input['maturite_residuelle']);
$confiance_residuelle = mysqli_real_escape_string($connect, $input['confiance_residuelle']);
$id_mesure = mysqli_real_escape_string($connect, $input['id_mesure']);


$results["error"] = false;
$results["message"] = [];





// Verification du type de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_mesure_securite)) {
    $results["error"] = true;
    $results["message"]["type_attaquant"] = "Nom de la mesure invalide";
    ?>
    <strong style="color:#FF6565;">Nom de la mesure invalide </br></strong>
    <?php
}

// Verification du profil de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $description_mesure_securite)) {
    $results["error"] = true;
    $results["message"]["Profil de l'attaquant"] = "Description de la mesure invalide";
    ?>
    <strong style="color:#FF6565;">Description de la mesure invalide </br></strong>
    <?php
}

if ($input["action"] === 'edit' && $results["error"] === false) {
    //update la mesure
    $query = "
    UPDATE Y_mesure 
    SET 
    nom_mesure = '" . $nom_mesure_securite . "',
    description_mesure = '" . $description_mesure_securite . "'
    WHERE id_mesure = '" . $input["id_mesure"] . "'
    ";
    mysqli_query($connect, $query);

    // recupere l'id du chemin d'attaque 
    $recupere_chemin = "SELECT id_chemin_d_attaque_strategique FROM ZB_comporter_2 WHERE id_mesure = $id_mesure";
    $result_chemin = mysqli_query($connect, $recupere_chemin);
    $id_chemin = (mysqli_fetch_array($result_chemin))["id_chemin_d_attaque_strategique"];

    // recupere l'id de la pp
    $recupere_pp = "SELECT id_partie_prenante FROM T_chemin_d_attaque_strategique WHERE id_chemin_d_attaque_strategique = $id_chemin";
    $result_pp = mysqli_query($connect, $recupere_pp);
    $id_pp = (mysqli_fetch_array($result_pp))["id_partie_prenante"];

    // recupere les valeurs de ponderation
    $recupere_ponderation = "SELECT ponderation_dependance, ponderation_penetration, ponderation_maturite, ponderation_confiance FROM R_partie_prenante WHERE id_partie_prenante = $id_pp";
    $result_ponderation = mysqli_query($connect, $recupere_ponderation);
    $row = mysqli_fetch_array($result_ponderation);
    $ponderation_dependance = $row["ponderation_dependance"];
    $ponderation_penetration = $row["ponderation_penetration"];
    $ponderation_maturite = $row["ponderation_maturite"];
    $ponderation_confiance = $row["ponderation_confiance"];
    
    $menace_residuelle = round(($dependance_residuelle*$ponderation_dependance * $penetration_residuelle*$ponderation_penetration) / ($maturite_residuelle*$ponderation_maturite * $confiance_residuelle*$ponderation_confiance), 2);
    
    //update les valeurs résiduelles du chemin
    $updatechemin = "
    UPDATE T_chemin_d_attaque_strategique
    SET dependance_residuelle = '" . $dependance_residuelle . "',
    penetration_residuelle = '" . $penetration_residuelle . "',
    maturite_residuelle = '" . $maturite_residuelle . "',
    confiance_residuelle = '" . $confiance_residuelle . "',
    niveau_de_menace_residuelle = '" . $menace_residuelle . "'
    WHERE id_chemin_d_attaque_strategique = '" . $id_chemin . "'
    " ;
    mysqli_query($connect, $updatechemin);
      
    
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM ZB_comporter_2 
    WHERE id_mesure = '".$input["id_mesure"]."'
    ";
    $query2 = "
    DELETE FROM Y_mesure 
    WHERE id_mesure = '".$input["id_mesure"]."'
    ";
    mysqli_query($connect, $query2);
}


echo json_encode($input);
