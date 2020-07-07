<?php
// header('Location: ../../../atelier-1d');

//Connexion à la base de donnee

use function PHPSTORM_META\type;

try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v14;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

// // var_dump($_FILES);
//set directory
$uploaddir  = "../../../uploads/";
//set future name of the file
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$uploadOk = 1;
//check type of the file, ie: JSON  
$fileType = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));
// print '$fileType = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));';
// print $fileType;
// print(filetype($uploadfile));
// print '<br />';

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
    // echo "File is not a json. ";
    // print '<br />';
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($uploadfile)) {
  // echo "Sorry, file already exists. ";
  // print '<br />';
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $fileType != "json"
) {
  // echo "Sorry, only json files are allowed. ";
  // print '<br />';
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  // echo "Your file was not uploaded. ";
  // print '<br />';
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $uploadfile)) {
    // echo "The file " . basename($_FILES["userfile"]["name"]) . " has been uploaded. ";
    // print '<br />';
  } else {
    // echo "Sorry, there was an error uploading your file. ";
    // print '<br />';
  }
}

//read the json file
$json = file_get_contents($uploadfile);
// // print 'json_decode($json, true) : ';
// // var_dump(json_decode($json, true));
// // print '<br />';
$data = json_decode($json, true);
// // print '$data : ';
// // var_dump($data);
// // print '<br />';


$recupere_id_socle_securite = $bdd->prepare("SELECT id_socle_securite FROM socle_de_securite WHERE nom_referentiel = ? AND id_atelier = '1.d' AND id_projet = '1'");



//trouve le socle
$type_referentiel = array_key_first($data);
$nom_referentiel = $data[$type_referentiel]['name'];
$exigence = $data[$type_referentiel]['Exigence'];
// print '<br />';

//recupere l'id du socle pour savoir s'il existe deja
$recupere_exist_socle = $bdd->prepare("SELECT * FROM socle_de_securite WHERE nom_referentiel = ? AND id_atelier = '1.d' AND id_projet = '1'");
$recupere_exist_socle->bindParam(1, $nom_referentiel);
$recupere_exist_socle->execute();
$exist_socle = $recupere_exist_socle->fetch();
// print '// print $exist_socle; ';
// var_dump($exist_socle);
// print '<br />';

//si le socle n'existe pas encore
if ($exist_socle == false) {
  // print '$exist_socle[0] == 0';
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
          VALUES (?, ?, ?, NULL, NULL, "1.d", "1")'
  );
  //insere le socle
  $insere_socle->bindParam(1, $id_socle_securite);
  $insere_socle->bindParam(2, $type_referentiel);
  $insere_socle->bindParam(3, $nom_referentiel);
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
  // print 'règle ' . $regle . ' à les paramètres suivant:';
  // print '<br />';
  // print '<br />';
  foreach ($parametres as $key => $value) {
    // print $key . ' : ' . $value;
    // print '<br />';
    //pour chaque parametre d'une regle, les rentre dans une array qui les groupe
    $key_id_titre_desc[$key] = $value;
    // print_r($key_id_titre_desc);
    // print '<br />';
    // print '<br />';
  }

  $new_id_regle = ($id_socle_securite[0] . $key_id_titre_desc['id']);

  //recupere l'id de la regle pour savoir si elle existe deja
  $recupere_exist_regle = $bdd->prepare("SELECT * FROM regle WHERE id_socle_securite = ? AND id_regle = ?");
  $recupere_exist_regle->bindParam(1, $id_socle_securite[0]);
  $recupere_exist_regle->bindParam(2, $new_id_regle);
  $recupere_exist_regle->execute();
  $exist_regle = $recupere_exist_regle->fetch();


  // // print '// print $exist_regle; ';
  // // var_dump($exist_regle);
  // // print '<br />';
  //si la regle n'existe pas ecore
  if ($exist_regle == false) {
    //insère les régles avec les paramètres groupés
    $insere_regle = $bdd->prepare(
      "INSERT INTO regle(
    regle.id_regle,
    regle.titre,
    regle.description, 
    regle.etat_de_la_regle, 
    regle.id_socle_securite) 
    VALUES (?, ?, ?, NULL, ?)"
    );

    $insere_regle->bindParam(1, $new_id_regle);
    $insere_regle->bindParam(2, $key_id_titre_desc['Titre']);
    $insere_regle->bindParam(3, $key_id_titre_desc['Description']);

    $insere_regle->bindParam(4, $id_socle_securite[0]);
    $insere_regle->execute();
    // print '<br />';
  }
}
$recupere_tableau = $bdd->prepare(
  "SELECT 
  id_socle_securite, 
  type_referentiel, 
  nom_referentiel, 
  etat_d_application, 
  etat_de_la_conformite, 
  id_atelier, 
  id_projet 
  FROM socle_de_securite 
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
    <td>'". $row["etat_de_la_conformite"] . "'</td>
  </tr>";
}
