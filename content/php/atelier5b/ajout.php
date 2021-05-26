<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_chemin_d_attaque_strategique = $_POST['chemin'];
$nom_mesure = $_POST['nommesure'];
$description_mesure = $_POST['descriptionmesure'];
$id_atelier = "5.b";

$insere_mesure = $bdd->prepare('INSERT INTO Y_mesure (nom_mesure, description_mesure, id_projet, id_atelier) VALUES (?,?,?,?)');
$recupere_mesure = $bdd->prepare('SELECT `id_mesure` FROM Y_mesure WHERE nom_mesure = ? AND description_mesure = ? AND id_projet = ?');
$insere_comporte = $bdd->prepare('INSERT INTO ZB_comporter_2 (id_mesure, id_chemin_d_attaque_strategique, id_projet) VALUES (?,?,?)');
$insere_traitement = $bdd->prepare('INSERT INTO ZA_traitement_de_securite (id_traitement_de_securite, id_atelier, id_projet, id_mesure) VALUES (?,?,?,?)');
$recupere_comporte = $bdd->prepare('SELECT id_mesure, id_chemin_d_attaque_strategique FROM ZB_comporter_2 WHERE id_projet=?');

// Verification du nom de la mesure
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{0,100}$/", $nom_mesure)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Nom de la mesure invalide";
}
// Verification de la description de la mesure
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{0,100}$/", $description_mesure)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Description de la mesure invalide";
}


if ($results["error"] === false && isset($_POST['ajouterregle'])) {

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
      // Insérer mesure
      $insere_mesure->bindParam(1, $nom_mesure);
      $insere_mesure->bindParam(2, $description_mesure);
      $insere_mesure->bindParam(3, $get_id_projet);
      $insere_mesure->bindParam(4, $id_atelier);
      $insere_mesure->execute();

      $recupere_mesure->bindParam(1, $nom_mesure);
      $recupere_mesure->bindParam(2, $description_mesure);
      $recupere_mesure->bindParam(3, $get_id_projet);
      $recupere_mesure->execute();
      $id_mesure_2 = $recupere_mesure->fetch();

      // insere dans comporte2
      $insere_comporte->bindParam(1, $id_mesure_2[0]);
      $insere_comporte->bindParam(2, $id_chemin_d_attaque_strategique);
      $insere_comporte->bindParam(3, $get_id_projet);
      $insere_comporte->execute();

      // Insérer un traitement de mesure
      $insere_traitement->bindParam(1, $id_traitement);
      $insere_traitement->bindParam(2, $id_atelier);
      $insere_traitement->bindparam(3, $get_id_projet);
      $insere_traitement->bindParam(4, $id_mesure_2[0]);
      $insere_traitement->execute();
      $_SESSION['message_success'] = "La mesure de sécurité a été correctement ajoutée!";
    }

    else {  
      // insere dans comporte2
      $insere_comporte->bindParam(1, $id_mesure[0]);
      $insere_comporte->bindParam(2, $id_chemin_d_attaque_strategique);
      $insere_comporte->bindParam(3, $get_id_projet);
      $insere_comporte->execute();

      // Insérer un traitement de mesure
      $insere_traitement->bindParam(1, $id_traitement);
      $insere_traitement->bindParam(2, $id_atelier);
      $insere_traitement->bindparam(3, $get_id_projet);
      $insere_traitement->bindParam(4, $id_mesure[0]);
      $insere_traitement->execute();
      $_SESSION['message_success'] = "La mesure de sécurité a été correctement ajoutée!";
    }
  }
  else {
    $_SESSION['message_error'] = "Le lien mesure-risque entré existe déjà !";
  }
} 

header('Location: ../../../atelier5b.php?id_utilisateur=' . $_SESSION['id_utilisateur'] . '&id_projet=' . $_SESSION['id_projet'] . '#plan_amelioration_continue_de_la_securite');
