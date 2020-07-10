<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v17");

$input = filter_input_array(INPUT_POST);

$etat_de_la_regle = mysqli_real_escape_string($connect, $input['etat_de_la_regle']);
$justification_ecart = mysqli_real_escape_string($connect, $input['justification_ecart']);
$responsable = mysqli_real_escape_string($connect, $input['responsable']);
$dates = mysqli_real_escape_string($connect, $input['dates']);
$id_regle = $input['id_regle'];
print $id_regle;
print '<br>';

$results["error"] = false;
$results["message"] = [];

if ($input["action"] === 'edit' && $results["error"] === false) {

    // $query_id_ecart = "SELECT id_ecarts FROM ecarts WHERE id_regle = '$id_regle'";
    // print $query_id_ecart;
    // print '<br>';

    // $result_id_ecart = mysqli_query($connect, $query_id_ecart);
    // $id_ecarts = mysqli_fetch_array($result_id_ecart);
    // print_r($id_ecarts);
    // print '<br>';

    // $insere_date = "INSERT INTO dates(id_date, date) VALUES ('','$dates')";
    // mysqli_query($connect, $insere_date);
    // print $insere_date;
    // print '<br>';

    // $recupere_id_date = "SELECT id_date FROM dates WHERE date = '$dates'";
    // $result_id_date = mysqli_query($connect, $recupere_id_date);
    // $id_date = mysqli_fetch_array($result_id_date);
    // print $recupere_id_date;
    // print '<br>';
    // print_r($id_date);
    // print '<br>';

    // $insere_personne = "INSERT INTO personne(id_personne, responsable, prenom, poste) VALUES ('','$responsable',NULL,NULL)";
    // mysqli_query($connect, $insere_personne);
    // print $insere_personne;
    // print '<br>';

    // $recupere_id_personne = "SELECT id_personne FROM personne WHERE responsable = '$responsable' AND prenom IS NULL AND poste IS NULL";
    // $result_id_personne = mysqli_query($connect, $recupere_id_personne);
    // $id_personne = mysqli_fetch_array($result_id_personne);
    // print $recupere_id_personne;
    // print '<br>';
    // print_r($id_personne);
    // print '<br>';


    $query_regle =
    "UPDATE regle 
    SET
    etat_de_la_regle = '$etat_de_la_regle',
    justification_ecart = '$justification_ecart',
    dates = '$dates',
    responsable = '$responsable'
    WHERE id_regle = $id_regle";
    print $query_regle;
    // echo $query_regle;
    // print '</br>';
    mysqli_query($connect, $query_regle);

    // $query_ecarts =
    //     "UPDATE ecarts 
    //         SET 
    //         justification_ecart = '$justification_ecart',
    //         id_regle = $id_regle,
    //         id_date = '$id_date[0]',
    //         id_personne = '$id_personne[0]'
    //         WHERE id_ecarts = $id_ecarts[0]";

    // print $query_ecarts;
    // print '<br>';
    // mysqli_query($connect, $query_ecarts);
}
if ($input["action"] === 'delete') {
    $query =
        "DELETE FROM regle 
        WHERE id_regle = $id_regle";
    mysqli_query($connect, $query);
}


echo json_encode($input);
