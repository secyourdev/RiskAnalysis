<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");

$input = filter_input_array(INPUT_POST);

$principe = mysqli_real_escape_string($connect, $input['principe_de_securite']);
$responsable = mysqli_real_escape_string($connect, $input['responsable']);
$difficulte = mysqli_real_escape_string($connect, $input['difficulte_traitement_de_securite']);
$cout = mysqli_real_escape_string($connect, $input['cout_traitement_de_securite']);
$date = mysqli_real_escape_string($connect, $input['date_traitement_de_securite']);
$statut = mysqli_real_escape_string($connect, $input['statut']);


$results["error"] = false;
$results["message"] = [];






// Verification du profil de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $responsable)) {
    $results["error"] = true;
    $results["message"]["Profil de l'attaquant"] = "Responsable invalide";
    ?>
    <strong style="color:#FF6565;">Responsable invalide </br></strong>
    <?php
}

// Verification de la description de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $difficulte)) {
    $results["error"] = true;
    $results["message"]["impact"] = "Difficulté invalide";
    ?>
    <strong style="color:#FF6565;">Difficulté invalide </br></strong>
    <?php
}


// Verification de la description de l'objectif visé
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $statut)) {
    $results["error"] = true;
    $results["message"]["description objectif vise"] = "Statut invalide";
    ?>
    <strong style="color:#FF6565;">Statut invalide </br></strong>
    <?php
}

if ($input["action"] === 'edit' && $results["error"] === false) {
    
    $query = "
    UPDATE traitement_de_securite 
    SET principe_de_securite = '".$principe."',
    responsable = '".$responsable."',
    difficulte_traitement_de_securite = '".$difficulte."',
    cout_traitement_de_securite = '".$cout."',
    date_traitement_de_securite = '".$date."',
    statut = '".$statut."'
    WHERE id_traitement_de_securite = '".$input["id_traitement_de_securite"]."'
    ";
    mysqli_query($connect, $query);
}



echo json_encode($input);
