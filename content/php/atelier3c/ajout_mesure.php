<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

<<<<<<< HEAD
$id_partie_prenante = $_POST['partieprenante1'];
$chemin = $_POST['chemins'];

// Pour les régles du référentiel
$nom_mesure = $_POST['nommesure'];
$description_mesure = $_POST['descriptionmesure'];
$id_traitement = "id_traitement";
$id_atelier = '3.c';

  // Verification du nom_mesure
  if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_mesure)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Nom mesure de sécurité invalide";
  }
  // Verification du description_mesure
  if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description_mesure)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Description mesure de sécurité invalide";
  }



$insere_mesure = $bdd->prepare("INSERT INTO Y_mesure (id_mesure, nom_mesure, description_mesure,id_projet, id_atelier) VALUES (?,?,?, $getid_projet ,'$id_atelier')");


$recupere_mesure = $bdd->prepare("SELECT id_mesure FROM Y_mesure WHERE nom_mesure = ? AND description_mesure = ? AND id_projet = $getid_projet");

$recupere_risque = $bdd->prepare("SELECT id_risque FROM T_chemin_d_attaque_strategique WHERE id_chemin_d_attaque_strategique = ? AND id_projet = $getid_projet");

$insere_comporte = $bdd->prepare("INSERT INTO ZB_comporter_2 (id_mesure, id_chemin_d_attaque_strategique, id_risque) VALUES (?,?,?)");
$insere_traitement = $bdd->prepare('INSERT INTO ZA_traitement_de_securite (id_traitement_de_securite, id_atelier, id_projet, id_mesure) VALUES (?, ?, ?, ?)');



if ($results["error"] === false && isset($_POST['validermesure1'])) {
  // insere mesure
  $insere_mesure->bindParam(1, $nom_mesure);
  $insere_mesure->bindParam(2, $nom_mesure);
  $insere_mesure->bindParam(3, $description_mesure);
  $insere_mesure->execute();
  // // recupere l'id de la mesure
  $recupere_mesure->bindParam(1, $nom_mesure);
  $recupere_mesure->bindParam(2, $description_mesure);
  $recupere_mesure->execute();
  $id_mesure = $recupere_mesure->fetch();
  // // recupere l'ID du risque
  $recupere_risque->bindParam(1, $chemin);
  $recupere_risque->execute();
  $id_risque = $recupere_risque->fetch();
  // // insere dans comporte4
  $insere_comporte->bindParam(1, $id_mesure[0]);
  $insere_comporte->bindParam(2, $chemin);
  $insere_comporte->bindParam(3, $id_risque[0]);
  $insere_comporte->execute();


  $insere_traitement->bindParam(1, $id_traitement);
  $insere_traitement->bindParam(2, $id_atelier);
  $insere_traitement->bindparam(3, $getid_projet);
  $insere_traitement->bindParam(4, $id_mesure[0]);
  $insere_traitement->execute();
  $_SESSION['message_success'] = "La mesure a bien été ajoutée !";
=======
$id_chemin_d_attaque_strategique = $_POST['chemins'];
$id_partie_prenante = $_POST['partie_prenante'];
$nom_mesure = $_POST['nommesure'];
$description_mesure = $_POST['descriptionmesure'];
$id_atelier = '3.c';

$insere_mesure = $bdd->prepare("INSERT INTO Y_mesure (nom_mesure, description_mesure, id_projet, id_atelier) VALUES (?,?,?,?)");
$recupere_mesure = $bdd->prepare('SELECT `id_mesure` FROM Y_mesure WHERE nom_mesure = ? AND description_mesure = ? AND id_projet = ?');
$insere_comporte = $bdd->prepare("INSERT INTO ZB_comporter_2 (id_mesure, id_partie_prenante, id_chemin_d_attaque_strategique, id_projet) VALUES (?,?,?,?)");
$insere_traitement = $bdd->prepare('INSERT INTO ZA_traitement_de_securite (id_traitement_de_securite, id_atelier, id_projet, id_mesure) VALUES (?,?,?,?)');
$recupere_comporte = $bdd->prepare('SELECT id_mesure, id_chemin_d_attaque_strategique FROM ZB_comporter_2 WHERE id_projet=?');

// Verification du nom_mesure
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_mesure)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Nom mesure de sécurité invalide";
}
// Verification du description_mesure
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description_mesure)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Description mesure de sécurité invalide";
}

if ($results["error"] === false && isset($_POST['validermesure1'])) {

  $recupere_comporte->bindParam(1, $id_projet);
  $recupere_comporte->execute();
  $result_comporte = $recupere_comporte->fetchAll(PDO::FETCH_COLUMN);

  // Récupérer id de la mesure
  $recupere_mesure->bindParam(1, $nom_mesure);
  $recupere_mesure->bindParam(2, $description_mesure);
  $recupere_mesure->bindParam(3, $get_id_projet);
  $recupere_mesure->execute();
  $id_mesure = $recupere_mesure->fetch();

  if (!in_array($id_mesure, $result_comporte)) {//Gérer les duplications via des erreurs (ne fonctionne pas)
    if(!isset($id_mesure[0])){
      // insere mesure
      $insere_mesure->bindParam(1, $nom_mesure);
      $insere_mesure->bindParam(2, $description_mesure);
      $insere_mesure->bindParam(3, $getid_projet);
      $insere_mesure->bindParam(4, $id_atelier);
      $insere_mesure->execute();

      $recupere_mesure->bindParam(1, $nom_mesure);
      $recupere_mesure->bindParam(2, $description_mesure);
      $recupere_mesure->bindParam(3, $get_id_projet);
      $recupere_mesure->execute();
      $id_mesure_2 = $recupere_mesure->fetch();

      // insere dans comporte2
      $insere_comporte->bindParam(1, $id_mesure_2[0]);
      $insere_comporte->bindParam(2, $id_partie_prenante);
      $insere_comporte->bindParam(3, $id_chemin_d_attaque_strategique);
      $insere_comporte->bindParam(4, $getid_projet);
      $insere_comporte->execute();

      // insere dans traitement de sécurité
      $insere_traitement->bindParam(1, $id_traitement);
      $insere_traitement->bindParam(2, $id_atelier);
      $insere_traitement->bindparam(3, $getid_projet);
      $insere_traitement->bindParam(4, $id_mesure_2[0]);
      $insere_traitement->execute();
      $_SESSION['message_success'] = "La mesure a bien été ajoutée !";
    }
    else{
      // insere dans comporte2
      $insere_comporte->bindParam(1, $id_mesure[0]);
      $insere_comporte->bindParam(2, $id_partie_prenante);
      $insere_comporte->bindParam(3, $id_chemin_d_attaque_strategique);
      $insere_comporte->bindParam(4, $getid_projet);
      $insere_comporte->execute();
  
      // insere dans traitement de sécurité
      $insere_traitement->bindParam(1, $id_traitement);
      $insere_traitement->bindParam(2, $id_atelier);
      $insere_traitement->bindparam(3, $getid_projet);
      $insere_traitement->bindParam(4, $id_mesure[0]);
      $insere_traitement->execute();
      $_SESSION['message_success'] = "La mesure a bien été ajoutée !";
    }
  }
  else {
    $_SESSION['message_error'] = "Le lien mesure-risque entré existe déjà !";
  }
>>>>>>> origin/Carlos
}

header('Location: ../../../atelier-3c&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#mesure_de_securite');
?>