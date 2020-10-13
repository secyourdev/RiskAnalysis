<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

//Connexion à la base de donnee
include("../bdd/connexion_sqli.php");

//if file exists / is selected
if ($_FILES['inpFile']['size'] != 0) {
    print 'le boutton file_submit a été pressé, une image a été selectionné. ';

    // Get image name
    $image = $_FILES['inpFile']['name'];

    // image file directory
    $target = "../../../image/" . basename($image);

    //if selection d'un scénario stratégique ou operationnel
    if (isset($_POST['select_nom_scenario_strategique'])) {
        $id_scenario = $_POST['select_nom_scenario_strategique'];
        $sql = "UPDATE S_scenario_strategique SET images = '$image' WHERE id_projet = $getid_projet AND id_atelier = '3.b' AND id_scenario_strategique = $id_scenario";
        $header = 'Location: ../../../atelier-3b&' . $_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#schemas_scenarios_strategiques';
    }
    if (isset($_POST['select_nom_scenario_operationnel'])) {
        $id_scenario = $_POST['select_nom_scenario_operationnel'];
        $sql = "UPDATE U_scenario_operationnel SET images = '$image' WHERE id_projet = $getid_projet AND id_atelier = '4.a' AND id_scenario_operationnel = $id_scenario";
        $header = 'Location: ../../../atelier-4a&' . $_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#schema_scenarios_operationnels';
    }

    //if selection du scénario a été faite
    if (isset($id_scenario)) {
        // execute query
        mysqli_query($connect, $sql);

        if (move_uploaded_file($_FILES['inpFile']['tmp_name'], $target)) {
            header($header);
            $_SESSION['message_success_2'] = "Image uploadée avec succès !";
            $zip = new ZipArchive;
            if ($zip->open('../sauvegarde_image/schema.zip') === TRUE) {
                $zip->addFile('../../../image/' . $image, $image);
                $zip->close();
                echo 'ok';
            } else {
                echo 'échec';
            }
        } else {
            $_SESSION['message_error_2'] = "Erreur dans l'upload de l'image !";
        }
    } else {
        $_SESSION['message_error_3'] = "Aucun scénario n'a été choisi";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}else{ //image does not exist or was not selected
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
