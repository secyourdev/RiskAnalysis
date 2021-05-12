<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$type_referenciel = $_POST['type_referenciel'];
$nom_referentiel = $_POST['nom_referentiel'];
$etat_d_application = $_POST['etat_d_application'];
$etat_de_la_conformite = $_POST['commentaire'];

$id_socle_securite = "id_socle_securite";
$id_atelier = "1.d";

$insere = $bdd->prepare("INSERT INTO N_socle_de_securite(id_socle_securite, type_referentiel, nom_referentiel, etat_d_application, etat_de_la_conformite, id_atelier, id_projet) VALUES (?,?,?,?,?,?,?)");

// Verification du type_referenciel
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $type_referenciel)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Type du référenciel invalide";
}

// Verification du nom_referentiel
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_referentiel)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Nom invalide";
}

// Verification du etat_d_application
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $etat_d_application)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "État de l'application invalide";
}

// Verification du etat_de_la_conformite
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $etat_de_la_conformite)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Commentaire invalide";
}

if ($results["error"] === false && isset($_POST['validersocle'])) {
  $insere->bindParam(1, $id_socle_securite);
  $insere->bindParam(2, $type_referenciel);
  $insere->bindParam(3, $nom_referentiel);
  $insere->bindParam(4, $etat_d_application);
  $insere->bindParam(5, $etat_de_la_conformite);
  $insere->bindParam(6, $id_atelier);
  $insere->bindParam(7, $getid_projet);
  $insere->execute();

  $_SESSION['message_success'] = "Le socle de sécurité a bien été ajouté !";
}

header('Location: ../../../atelier-1d&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet'].'#socle');