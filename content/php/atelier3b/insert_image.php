<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

//Connexion à la base de donnee
include("../bdd/connexion_sqli.php");

// Initialize message variable
$msg = "";


print "bonjour";
print_r($_POST); //ce qui est reçu du ajax


//if file exists / is selected
if ($_FILES['inpFile']['size'] != 0) {
    print 'le boutton file_submit a été pressé, une image a été selectionné. ';

    // Get image name
    $image = $_FILES['inpFile']['name'];
    print($image != NULL);


    // image file directory
    $target = "../../../image/" . basename($image);


    //if selection d'un scénario stratégique ou operationnel
    if (isset($_POST['select_nom_scenario_strategique'])) {
        // print 'select_nom_scenario_strategique séléctionné, id: ';
        $id_scenario = $_POST['select_nom_scenario_strategique'];
        // print $id_scenario;
        $sql = "UPDATE S_scenario_strategique SET image = '$image' WHERE id_projet = $getid_projet AND id_atelier = '3.b' AND id_scenario_strategique = $id_scenario";
        // print $sql;
        $header = 'Location: ../../../atelier-3b&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet'];
    }
    if (isset($_POST['select_nom_scenario_operationnel'])) {
        // print 'select_nom_scenario_operationnel séléctionné, id: ';
        $id_scenario = $_POST['select_nom_scenario_operationnel'];
        // print $id_scenario;
        $sql = "UPDATE U_scenario_operationnel SET image = '$image' WHERE id_projet = $getid_projet AND id_atelier = '4.a' AND id_scenario_operationnel = $id_scenario";
        $header = 'Location: ../../../atelier-4a&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet'];
        print $sql;
    }

    //if selection du scénario a été faite
    if (isset($id_scenario)) {

        print $sql;
        // execute query
        mysqli_query($connect, $sql);

        if (move_uploaded_file($_FILES['inpFile']['tmp_name'], $target)) {
            header($header);
            //$msg = "Image uploadée avec succès";
            $_SESSION['message_success_2'] = "Image uploadée avec succès !";
            //print $msg;
            $zip = new ZipArchive;
            if ($zip->open('../sauvegarde_image/schema.zip') === TRUE) {
                $zip->addFile('../../../image/' . $image, $image);
                $zip->close();
                echo 'ok';
            } else {
                echo 'échec';
            }
        } else {
            //$msg = "Erreur dans l'upload de l'image";
            $_SESSION['message_error_2'] = "Erreur dans l'upload de l'image !";
            //print $msg;
        }
    } else {
        //print "erreur: aucun scénario n'a été choisi";
        $_SESSION['message_error_2'] = "Aucun scénario n'a été choisi";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}else{ //image does not exist or was not selected
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
