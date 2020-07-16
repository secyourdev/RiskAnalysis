<?php
// session_start();
session_start();
$getid_projet = $_SESSION['id_projet'];

//Connexion à la base de donnee
$bdd = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v20");

// Initialize message variable
$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {
    // Get image name
    $image = $_FILES['image']['name'];
    //   print_r($image);
    // Get text
    // $image_text = mysqli_real_escape_string($bdd, $_POST['image_text']);
    
    // image file directory
    $target = "image/".basename($image);
    //   print '<br>';
    //   print($target);
    
    //   $sql = "INSERT INTO scenario_operationnel (image) VALUES ('$image')";

    $sql = "UPDATE scenario_operationnel SET image = '$image' WHERE id_projet = $getid_projet AND id_atelier = '3.b' AND id_scenario_operationnel = 17";
    print '<br>';
    print $sql;
    if (isset($_POST['id_scenario_operationnel'])) {
        $id_scenario_operationnel = $_POST['id_scenario_operationnel'];
    }
    print '<br>';
    print $id_scenario_operationnel;
    // execute query
    mysqli_query($bdd, $sql);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // header('Location: testimage.php?id_utilisateur=100&id_projet=17');
          $msg = "Image uploaded successfully";

  	}else{
  		$msg = "Failed to upload image";
  	}
  }