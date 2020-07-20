<?php
// session_start();
session_start();
$getid_projet = $_SESSION['id_projet'];

//Connexion à la base de donnee
include("../bdd/connexion_sqli.php");

// Initialize message variable
$msg = "";


print "bonjour";
print_r($_POST); //ce qui est reçu du ajax


// If upload button is clicked ...
if (isset($_POST['file_submit'])) {
    print 'le boutton file_submit a été pressé. ';

    // Get image name
    $image = $_FILES['inpFile']['name'];
    // image file directory
    $target = "../../../image/" . basename($image);


    //if selection d'un scénario stratégique ou operationnel
    if (isset($_POST['select_nom_scenario_strategique'])) {
        // print 'select_nom_scenario_strategique séléctionné, id: ';
        $id_scenario = $_POST['select_nom_scenario_strategique'];
        // print $id_scenario;
        $sql = "UPDATE scenario_strategique SET image = '$image' WHERE id_projet = $getid_projet AND id_atelier = '3.b' AND id_scenario_strategique = $id_scenario";
        // print $sql;
        $header = 'Location: ../../../atelier-3b&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet'];
    }
    if (isset($_POST['select_nom_scenario_operationnel'])) {
        // print 'select_nom_scenario_operationnel séléctionné, id: ';
        $id_scenario = $_POST['select_nom_scenario_operationnel'];
        // print $id_scenario;
        $sql = "UPDATE scenario_operationnel SET image = '$image' WHERE id_projet = $getid_projet AND id_atelier = '4.a' AND id_scenario_operationnel = $id_scenario";
        $header = 'Location: ../../../atelier-4a&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet'];
        print $sql;
    }

    //if selection du scénario a été faite
    if (isset($id_scenario)) {

        print $sql;
        // execute query
        mysqli_query($bdd, $sql);

        if (move_uploaded_file($_FILES['inpFile']['tmp_name'], $target)) {
            header($header);
            $msg = "Image uploadée avec succès";
            print $msg;
        } else {
            $msg = "Erreur dans l'upload de l'image";
            print $msg;
        }

    }else {
        print "erreur: aucun scénario n'a été choisi";
    }
}
