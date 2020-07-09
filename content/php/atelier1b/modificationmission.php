<?php
//action.php
session_start();
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v14");

$input = filter_input_array(INPUT_POST);


$nom_mission = mysqli_real_escape_string($connect, $input["nom_mission"]);
$respo_mis_nom = mysqli_real_escape_string($connect, $input["respo_mis_nom"]);
$respo_mis_prenom = mysqli_real_escape_string($connect, $input["respo_mis_prenom"]);
$respo_mis_poste = mysqli_real_escape_string($connect, $input["respo_mis_poste"]);

$nom_valeur_metier = mysqli_real_escape_string($connect, $input["nom_valeur_metier"]);
$respo_val_nom = mysqli_real_escape_string($connect, $input["respo_val_nom"]);
$nom_bien_support = mysqli_real_escape_string($connect, $input["nom_bien_support"]);
$respo_bien_nom = mysqli_real_escape_string($connect, $input["respo_bien_nom"]);



$results["error"] = false;
$results["message"] = [];

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];;

// Verification de la mission
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_mission)) {
    $results["error"] = true;
    $results["message"]["prenom"] = "Mission invalide";
?>
    <strong style="color:#FF6565;">Mission invalide </br></strong>
<?php
}

// Verification du respo_mis_nom du responsable
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $respo_mis_nom)) {
    $results["error"] = true;
    $results["message"]["respo_mis_nom"] = "respo_mis_nom invalide";
?>
    <strong style="color:#FF6565;">respo_mis_nom invalide </br></strong>
<?php
}

// Verification du respo_mis_prenom du responsable
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $respo_mis_prenom)) {
    $results["error"] = true;
    $results["message"]["respo_mis_prenom"] = "respo_mis_prenom invalide";
?>
    <strong style="color:#FF6565;">respo_mis_prenom invalide </br></strong>
<?php
}

// Verification du respo_mis_poste du responsable
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $respo_mis_poste)) {
    $results["error"] = true;
    $results["message"]["respo_mis_poste"] = "respo_mis_poste invalide";
?>
    <strong style="color:#FF6565;">respo_mis_poste invalide </br></strong>
<?php
}



if ($input["action"] === 'edit' && $results["error"] === false) {
    $queryp = 
    "UPDATE personne
    SET nom = '" . $respo_mis_nom . "',
    prenom = '" . $respo_mis_prenom . "',
    poste = '" . $respo_mis_poste . "'
    WHERE id_personne = (SELECT id_personne FROM mission WHERE id_mission = '" . $input["id_mission"] . "')
    ";

    $querym = 
    "UPDATE mission 
    SET nom_mission = '" . $nom_mission . "'
    WHERE id_mission = '" . $input["id_mission"] . "'
    ";

    $queryvm = 
    "UPDATE valeur_metier 
    SET id_mission = (SELECT id_mission FROM mission WHERE nom_mission = '" . $nom_mission . "'
    WHERE nom_valeur_metier = '" . $input["nom_valeur_metier"] . "'
    AND id_atelier = '" . $id_atelier . "'
    AND id_projet = " . $id_projet . "
    ";

    mysqli_query($connect, $queryp);
    mysqli_query($connect, $querym);
    mysqli_query($connect, $queryvm);
}

if ($input["action"] === 'delete') {
    $query = 
    "DELETE FROM mission 
    WHERE id_mission = '" . $input["id_mission"] . "'
    AND id_atelier = '" . $id_atelier . "'
    AND id_projet = " . $id_projet . "
    ";
    echo $query;
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>