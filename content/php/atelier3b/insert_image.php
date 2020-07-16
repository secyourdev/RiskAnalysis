<?php
// session_start();
session_start();
$getid_projet = $_SESSION['id_projet'];

//Connexion à la base de donnee
$bdd = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v20");

// Initialize message variable
$msg = "";


print "bonjour";
print_r($_POST);



// If upload button is clicked ...
if (isset($_POST['nom_scenario_strategique'])) {
    print 'nom_scenario_strategique séléctionné, id: ';
    $id_scenario_strategique = $_POST['nom_scenario_strategique'];
    print $id_scenario_strategique;


    if (isset($_POST['file_submit'])) {
        print 'le boutton file_submit a été pressé. ';



        // Get image name
        $image = $_FILES['inpFile']['name'];
        // image file directory
        $target = "../../../image/" . basename($image);

        $sql = "UPDATE scenario_stratéquique SET image = '$image' WHERE id_projet = $getid_projet AND id_atelier = '3.b' AND id_scenario_strategique = $id_scenario_strategique";
        print $sql;
        // execute query
        mysqli_query($bdd, $sql);

        if (move_uploaded_file($_FILES['inpFile']['tmp_name'], $target)) {
            header('Location: ../../../atelier-3b&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet']);
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }
    }
}
