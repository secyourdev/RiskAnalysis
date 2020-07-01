<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v12");

$input = filter_input_array(INPUT_POST);

$etat_d_application = mysqli_real_escape_string($connect, $input['etat_d_application']);
$etat_de_la_conformite = mysqli_real_escape_string($connect, $input['etat_de_la_conformite']);

$results["error"] = false;
$results["message"] = [];


/* 
// Verification du etat_d_application
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $etat_d_application)) {
    $results["error"] = true;
    $results["message"]["etat_d_application"] = "Nom de l'évenement redouté invalide";
?>
    <strong style="color:#FF6565;">etat_d_application invalide </br></strong>
<?php
}

// Verification du etat_de_la_conformite
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $etat_de_la_conformite)) {
    $results["error"] = true;
    $results["message"]["etat_de_la_conformite"] = "Description de l'événement redouté invalide";
?>
    <strong style="color:#FF6565;">etat_de_la_conformite invalide </br></strong>
<?php
} */


if ($input["action"] === 'edit' && $results["error"] === false) {
    $query = "
    UPDATE socle_de_securite 
    SET
    etat_d_application = '" . $etat_d_application . "',
    etat_de_la_conformite = '" . $etat_de_la_conformite . "',
    id_atelier = '" . 1 . "',
    id_projet = '" . 1 . "'
    WHERE id_socle_securite = '" . $input["id_socle_securite"] . "'
    ";
    
    print $query;
    
    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = 
    "DELETE FROM socle_de_securite 
    WHERE id_socle_securite = " . $input["id_socle_securite"] . "";
    print $query;
    mysqli_query($connect, $query);
}


echo json_encode($input);
