<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;
$results["message"] = [];

// print $input["id_socle_securite"];

if ($input["action"] === 'edit') {

    if (isset($input['etat_d_application'])) {
        $etat_d_application = mysqli_real_escape_string($connect, $input['etat_d_application']);
    }
    if (isset($input['etat_de_la_conformite'])) {
        $etat_de_la_conformite = mysqli_real_escape_string($connect, $input['etat_de_la_conformite']);
    }

    // Verification du etat_d_application
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/", $etat_d_application)) {
        $results["error"] = true;
        $results["message"]["etat_d_application"] = "Nom de l'évenement redouté invalide";
?>
        <strong style="color:#FF6565;">etat_d_application invalide </br></strong>
    <?php
    }

    // Verification du etat_de_la_conformite
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,1000}$/", $etat_de_la_conformite)) {
        $results["error"] = true;
        $results["message"]["etat_de_la_conformite"] = "Description de l'événement redouté invalide";
    ?>
        <strong style="color:#FF6565;">etat_de_la_conformite invalide </br></strong>
<?php
    }
    
    if ($results["error"] === false) {
        $query =
            "UPDATE N_socle_de_securite 
    SET 
    etat_d_application = '" . $etat_d_application . "',
    etat_de_la_conformite = '" . $etat_de_la_conformite . "'
    WHERE id_socle_securite = '" . $input["id_socle_securite"] . "'
    AND id_atelier = '1.d' AND id_projet = $getid_projet";

        // print $query;
        // print_r(mysqli_query($connect, $query));
        mysqli_query($connect, $query);
    }
}

if ($input["action"] === 'delete') {
    $query =
        "DELETE FROM N_socle_de_securite 
    WHERE id_socle_securite = '" . $input["id_socle_securite"] . "'
    AND id_atelier = '1.d' AND id_projet = $getid_projet";
    // print $query;
    mysqli_query($connect, $query);
}


echo json_encode($input);
