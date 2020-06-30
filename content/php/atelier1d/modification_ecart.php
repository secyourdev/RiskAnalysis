<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v12");

$input = filter_input_array(INPUT_POST);

$etat_de_la_regle = mysqli_real_escape_string($connect, $input['etat_de_la_regle']);
$justification_ecart = mysqli_real_escape_string($connect, $input['justification_ecart']);
$nom = mysqli_real_escape_string($connect, $input['nom']);
$date = mysqli_real_escape_string($connect, $input['date']);

$results["error"] = false;
$results["message"] = [];


// Verification du etat_de_la_regle
/* if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $etat_de_la_regle)) {
    $results["error"] = true;
    $results["message"]["etat_de_la_regle"] = "Nom de l'évenement redouté invalide";
    ?>
    <strong style="color:#FF6565;">etat_de_la_regle invalide </br></strong>
    <?php
} */


if ($input["action"] === 'edit' && $results["error"] === false) {
    $query_date =
    "UPDATE dates 
    SET 
    date = '" . $date . "'
    WHERE id_date = (SELECT id_date FROM ecarts WHERE id_ecarts = " . $input["id_ecarts"] . ")";

    echo $query_date;
    print '</br>';

    $query_referentiel =
    "UPDATE referentiel 
    SET 
    etat_de_la_regle = '" . $etat_de_la_regle . "'
    WHERE id_regle = (SELECT id_regle FROM ecarts WHERE id_ecarts = " . $input["id_ecarts"] . ")";
    echo $query_referentiel;
    print '</br>';

    $query_responsable =
    "UPDATE personne 
    SET 
    nom = '" . $nom . "'
    WHERE id_personne = (SELECT id_personne FROM ecarts WHERE id_ecarts = " . $input["id_ecarts"] . ")";
    echo $query_responsable;
    print '</br>';
    
    $query_ecarts =
    "UPDATE ecarts 
    SET 
    justification_ecart = '" . $justification_ecart . "'
    WHERE id_ecarts = ". $input["id_ecarts"] . "";
    echo $query_ecarts;

    mysqli_query($connect, $query_date);
    print '</br>';
    print '1';
    mysqli_query($connect, $query_referentiel);
    print '</br>';
    print '2';
    mysqli_query($connect, $query_responsable);
    print '</br>';
    print '3';
    mysqli_query($connect, $query_ecarts);
    print '</br>';
    print '4';
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM evenement_redoutes 
    WHERE id_evenement_redoutes = '" . $input["id_evenement_redoutes"] . "'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
