<?php
// header('Refresh:5; Location: ../../../atelier-3c');

include("../bdd/connexion.php");

//set directory
$target_dir = "../../../uploads/";
//set future name of the file
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
//check type of the file, ie: JSON  
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
// if (isset($_POST["file_submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if ($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

if (isset($_POST["file_submit"])) {
  $sJson = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
  //try to decode it
  $json = json_decode($sJson);
  if (json_last_error() === JSON_ERROR_NONE) {
    //do something with $json. It's ready to use
    echo "File is a json. ";
    print '<br />';
    $uploadOk = 1;
  } else {
    //yep, it's not JSON. Log error or alert someone or do nothing
    echo "File is not a json. ";
    print '<br />';
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists. ";
  $uploadOk = 0;
}

// Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//   echo "Sorry, your file is too large.";
//   $uploadOk = 0;
// }

// Allow certain file formats
// if (
//   $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
//   && $fileType != "gif"
// ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

// Allow certain file formats
if (
  $fileType != "json"
) {
  echo "Sorry, only json files are allowed. ";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Your file was not uploaded. ";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded. ";
  } else {
    echo "Sorry, there was an error uploading your file. ";
  }
}

//read the json file
$json = file_get_contents($target_file);
$data = json_decode($json, true);
print '<br />';

//preparation des requetes
$insere_socle = $bdd->prepare(
  'INSERT INTO socle_de_securite
  (
    id_socle_securite, 
    type_referentiel, 
    nom_referentiel, 
    etat_d_application, 
    etat_de_la_conformite, 
    id_atelier,
    id_projet
  ) 
  VALUES (?, ?, ?, NULL, NULL, 1, 1)'
);

$recupere_id_socle_securite = $bdd->prepare("SELECT id_socle_securite FROM socle_de_securite WHERE nom_referentiel = ?");
$recupere_exist_socle = $bdd->prepare("SELECT EXISTS(SELECT * FROM socle_de_securite WHERE nom_referentiel = ?)");
$recupere_exist_regle = $bdd->prepare("SELECT EXISTS(SELECT * FROM referentiel WHERE id_socle_securite = ? AND id_regle = ?)");

$insere_regle = $bdd->prepare(
  'INSERT INTO referentiel
  (
    id_referentiel, 
    id_regle,
    titre,
    referentiel.description, 
    etat_de_la_regle, 
    id_socle_securite
    ) 
  VALUES ("", ?, ?, ?, NULL, ?)'
);

// //si le boutton d'ajout est presser
// if (isset($_POST['file_submit'])) {



  //trouve le socle
  $type_referentiel = array_key_first($data);
  $nom_referentiel = $data[$type_referentiel]['name'];
  $exigence = $data[$type_referentiel]['Exigence'];
  print '<br />';



  //recupere l'id du socle pour savoir s'il existe deja
  $recupere_exist_socle->bindParam(1, $nom_referentiel);
  $recupere_exist_socle->execute();
  $exist_socle = $recupere_exist_socle->fetch();
  print '<br />';



  //si le socle n'existe pas encore
  if ($exist_socle[0] == 0) {
    print '$exist_socle[0] == 0';
    //insere le socle
    $insere_socle->bindParam(1, $id_socle_securite);
    $insere_socle->bindParam(2, $type_referentiel);
    $insere_socle->bindParam(3, $nom_referentiel);
    $insere_socle->execute();
    print '<br />';
  }



  //recupere l'id du socle pour l'insertion de regles
  $recupere_id_socle_securite->bindParam(1, $nom_referentiel);
  $recupere_id_socle_securite->execute();
  $id_socle_securite = $recupere_id_socle_securite->fetch();

  //trouve les parametres pour chaques regles
  $key_id_titre_desc = array();
  foreach ($exigence as $regle => $parametres) {
    print 'règle ' . $regle . ' à les paramètres suivant:';
    print '<br />';
    print '<br />';
    foreach ($parametres as $key => $value) {
      print $key . ' : ' . $value;
      print '<br />';
      //pour chaque parametre d'une regle, les rentre dans une array qui les groupe
      $key_id_titre_desc[$key] = $value;
      print_r($key_id_titre_desc);
      print '<br />';
      print '<br />';
    }


    //recupere l'id de la regle pour savoir si elle existe deja
    $recupere_exist_regle->bindParam(1, $id_socle_securite[0]);
    $recupere_exist_regle->bindParam(2, $key_id_titre_desc['id']);
    $recupere_exist_regle->execute();
    $exist_regle = $recupere_exist_regle->fetch();



    //si la regle n'existe pas ecore
    if ($exist_regle[0] == 0) {
      print '$exist_regle[0] == 0';
      //insère les régles avec les paramètres groupés
      $insere_regle->bindParam(1, $key_id_titre_desc['id']);
      $insere_regle->bindParam(2, $key_id_titre_desc['Titre']);
      $insere_regle->bindParam(3, $key_id_titre_desc['Description']);
      $insere_regle->bindParam(4, $id_socle_securite[0]);
      $insere_regle->execute();
      print '<br />';
    }
  }

?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
// }

?>