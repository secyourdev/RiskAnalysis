<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v14");

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


    // $exist_ecart = "SELECT * FROM ecarts WHERE id_ecart = '" . $input["id_ecarts"] . "'";
    // $result_exist_ecart = mysqli_query($connect, $exist_ecart);
    // var_dump($result_exist_ecart);
    // $row = mysqli_fetch_array($result_exist_ecart);
    // print_r($row['id_ecarts']);

    $query_ecarts =
    "UPDATE ecarts 
    SET 
    justification_ecart = '" . $justification_ecart . "'
    WHERE id_ecarts = '" . $input["id_ecarts"] . "'";
    // echo $query_ecarts;
    
    $query_date =
    "UPDATE dates 
    SET 
    date = '" . $date . "'
    WHERE id_date = (SELECT id_date FROM ecarts WHERE id_ecarts = '" . $input["id_ecarts"] . "')";

    // echo $query_date;
    // print '</br>';

    $query_regle =
    "UPDATE regle 
    SET 
    etat_de_la_regle = '" . $etat_de_la_regle . "'
    WHERE id_regle = (SELECT id_regle FROM ecarts WHERE id_ecarts = '" . $input["id_ecarts"] . "')";
    // echo $query_regle;
    // print '</br>';

    $query_responsable =
    "UPDATE personne 
    SET 
    nom = '" . $nom . "'
    WHERE id_personne = (SELECT id_personne FROM ecarts WHERE id_ecarts = '" . $input["id_ecarts"] . "')";
    // echo $query_responsable;
    // print '</br>';
    


    mysqli_query($connect, $query_ecarts);
    mysqli_query($connect, $query_date);
    mysqli_query($connect, $query_regle);
    mysqli_query($connect, $query_responsable);
}
if ($input["action"] === 'delete') {
    $query = 
    "DELETE FROM ecarts 
    WHERE id_ecarts = '" . $input["id_ecarts"] . "'";
    mysqli_query($connect, $query);
}


echo json_encode($input);
