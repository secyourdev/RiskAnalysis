<?php

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");

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

if ($input["action"] === 'edit') {

    // Verification du justification_ecart
    if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $justification_ecart)) {
        $results["error"] = true;
        $results["message"]["justification_ecart"] = "Description de l'événement redouté invalide";
?>
        <strong style="color:#FF6565;">justification_ecart invalide </br></strong>
    <?php
    }
    // Verification du responsable
    if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $responsable)) {
        $results["error"] = true;
        $results["message"]["responsable"] = "Description de l'événement redouté invalide";
    ?>
        <strong style="color:#FF6565;">responsable invalide </br></strong>
    <?php
    }
    // Verification du dates
    if (!preg_match("/^[0-9\s-]{1,100}$/", $dates)) {
        $results["error"] = true;
        $results["message"]["dates"] = "Description de l'événement redouté invalide";
    ?>
        <strong style="color:#FF6565;">dates invalide </br></strong>
<?php
    }

    if ($results["error"] === false) {
        $query_regle =
            "UPDATE regle 
            SET
            etat_de_la_regle = '$etat_de_la_regle',
            justification_ecart = '$justification_ecart',
            dates = '$dates',
            responsable = '$responsable'
            WHERE id_regle = $id_regle";
        print $query_regle;

        mysqli_query($connect, $query_regle);
    }
}
if ($input["action"] === 'delete') {
    $query =
        "DELETE FROM regle 
        WHERE id_regle = $id_regle";
    mysqli_query($connect, $query);
}


echo json_encode($input);
