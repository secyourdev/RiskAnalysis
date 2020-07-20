<?php
// session_start();
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion_sqli.php");

// Initialize message variable
$msg = "";


print "bonjour";
print_r($_POST); //ce qui est reçu du ajax



// If upload button is clicked ...
if (isset($_POST['nom_scenario_operationnel'])) {
    // print 'nom_scenario_operationnel séléctionné, id: ';
    $id_scenario_operationnel = $_POST['nom_scenario_operationnel'];
    // print $id_scenario_operationnel;


    if (isset($_POST['file_submit'])) {
        print 'le boutton file_submit a été pressé. ';



        // Get image name
        $image = $_FILES['inpFile']['name'];
        // image file directory
        $target = "../../../image/" . basename($image);

        $sql = "UPDATE scenario_operationnel SET image = '$image' WHERE id_projet = $getid_projet AND id_atelier = '4.a' AND id_scenario_operationnel = $id_scenario_operationnel";
        // print $sql;
        // execute query
        mysqli_query($bdd, $sql);

        if (move_uploaded_file($_FILES['inpFile']['tmp_name'], $target)) {
            header('Location: ../../../atelier-4a&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet']);
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }
    }
}
