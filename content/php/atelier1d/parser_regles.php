<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

// header('Location: ../../../atelier-1d');

use function PHPSTORM_META\type;

include("../bdd/connexion.php");

//set directory
$uploaddir  = "../../../uploads/";
//set future name of the file
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$uploadOk = 1;


//check type of the file, ie: JSON  
$fileType = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));
if ($fileType != "json") {
  print "Sorry, only json files are allowed.";
} else {
  if (isset($_POST["file_submit"])) {
    $sJson = file_get_contents($_FILES["userfile"]["tmp_name"]);
    //try to decode it
    $json = json_decode($sJson);
    if (json_last_error() === JSON_ERROR_NONE) {
      //do something with $json. It's ready to use
      // echo "File is a json. ";
      // print '<br />';
      $uploadOk = 1;
    } else {
      //yep, it's not JSON. Log error or alert someone or do nothing
      print "File is not a json. Format error";
      print '<br />';
      $uploadOk = 0;
    }
  }
  // Check if file already exists -- if exist overwrite to update
  if (file_exists($uploadfile)) {
    print "you are about to overwrite already existing file: ";
    print $uploadfile;
    print '<br />';

    unlink($uploadfile);
    $uploadOk = 1;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    // print "Your file was not uploaded. ";

    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $uploadfile)) {
      print "The file " . basename($_FILES["userfile"]["name"]) . " has been uploaded. ";
    } else {
      print "Sorry, there was an error uploading your file. ";
    }
  }
  //read the json file uploaded
  $json = file_get_contents($uploadfile);
  $data = json_decode($json, true);



  $recupere_id_socle_securite = $bdd->prepare("SELECT id_socle_securite FROM N_socle_de_securite WHERE nom_referentiel = ? AND id_atelier = '1.d' AND id_projet = $getid_projet");

  //trouve le socle
  $type_referentiel = array_key_first($data);
  $nom_referentiel = $data[$type_referentiel]['name'];
  $exigence = $data[$type_referentiel]['Exigence'];
  // print '<br />';

  //recupere l'id du socle pour savoir s'il existe deja
  $recupere_exist_socle = $bdd->prepare("SELECT * FROM N_socle_de_securite WHERE nom_referentiel = ? AND id_atelier = '1.d' AND id_projet = $getid_projet");
  $recupere_exist_socle->bindParam(1, $nom_referentiel);
  $recupere_exist_socle->execute();
  $exist_socle = $recupere_exist_socle->fetch();

  //si le socle n'existe pas encore
  if ($exist_socle == false) {
    // print '$exist_socle[0] == 0';
    $insere_socle = $bdd->prepare(
      'INSERT INTO N_socle_de_securite
          (
            id_socle_securite, 
            type_referentiel, 
            nom_referentiel, 
            etat_d_application, 
            etat_de_la_conformite, 
            id_atelier,
            id_projet
          ) 
          VALUES (?, ?, ?, NULL, NULL, "1.d", ?)'
    );
    //insere le socle
    $insere_socle->bindParam(1, $id_socle_securite);
    $insere_socle->bindParam(2, $type_referentiel);
    $insere_socle->bindParam(3, $nom_referentiel);
    $insere_socle->bindParam(4, $getid_projet);
    $insere_socle->execute();

    // print '<br />';
  }

  //recupere l'id du socle pour l'insertion de regles
  $recupere_id_socle_securite->bindParam(1, $nom_referentiel);
  $recupere_id_socle_securite->execute();
  $id_socle_securite = $recupere_id_socle_securite->fetch();

  //trouve les parametres pour chaques regles
  $key_id_titre_desc = array();
  foreach ($exigence as $regle => $parametres) {
    //  print 'règle ' . $regle . ' à les paramètres suivant:';
    //  print '<br />';
    //  print '<br />';
    foreach ($parametres as $key => $value) {
    //  print $key . ' : ' . $value;
    //  print '<br />';

      //pour chaque parametre d'une regle, les rentre dans une array qui les groupe
      $key_id_titre_desc[$key] = $value;
    }

    $new_id_regle = (/* $id_socle_securite[0] . */ $key_id_titre_desc['id']);

    //recupere l'id de la regle pour savoir si elle existe deja
    $recupere_exist_regle = $bdd->prepare("SELECT * FROM O_regle WHERE id_socle_securite = ? AND id_regle = ?");
    $recupere_exist_regle->bindParam(1, $id_socle_securite[0]);
    $recupere_exist_regle->bindParam(2, $new_id_regle);
    $recupere_exist_regle->execute();
    $exist_regle = $recupere_exist_regle->fetch();

    //si la regle n'existe pas ecore
    if ($exist_regle == false) {

      //insère les régles avec les paramètres groupés
      $insere_regle = $bdd->prepare(
        "INSERT INTO O_regle(id_regle, id_regle_affichage, titre, description, etat_de_la_regle, justification_ecart, dates, responsable, id_socle_securite) 
    VALUES ('',?,?,?,NULL,NULL,NULL,NULL,?)"
      );

      $insere_regle->bindParam(1, $new_id_regle);
      $insere_regle->bindParam(2, $key_id_titre_desc['Titre']);
      $insere_regle->bindParam(3, $key_id_titre_desc['Description']);
      $insere_regle->bindParam(4, $id_socle_securite[0]);
      $insere_regle->execute();
    }
  }
  $recupere_tableau = $bdd->prepare(
    "SELECT * FROM N_socle_de_securite 
  WHERE id_socle_securite = ?"
  );
  $recupere_tableau->bindParam(1, $id_socle_securite[0]);
  $recupere_tableau->execute();
  $query = $recupere_tableau->fetch();

  while ($row = $recupere_tableau->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
  <td>'" . $row["id_socle_securite"] . "'</td>
  <td>'" . $row["type_referentiel"] . "'</td>
  <td>'" . $row["nom_referentiel"] . "'</td>
  <td>'" . $row["etat_d_application"] . "'</td>
  <td>'" . $row["etat_de_la_conformite"] . "'</td>
  </tr>";
  }
}
