<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;

$nom_referentiel = $_POST['nomreferentiel'];
$id_regle_affichage = $_POST['id_regle'];
$titre = $_POST['titre_regle'];
$description = $_POST['description'];
$etat_de_la_regle = '';
$justification_ecart = '';
$responsable = '';
$dates = '';

$recupere_id_socle = $bdd->prepare("SELECT id_socle_securite FROM N_socle_de_securite WHERE N_socle_de_securite.nom_referentiel = ? AND id_atelier = '1.d' AND id_projet = $getid_projet");

$insere_regle = $bdd->prepare(
  "INSERT INTO O_regle(id_regle, id_regle_affichage, titre, description, etat_de_la_regle, justification_ecart, dates, responsable, id_socle_securite, id_projet) 
VALUES ('',?,?,?,?,?,?,?,?, '1.d', $getid_projet)"
);

// Verification du nom_referentiel
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{1,100}$/", $nom_referentiel)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "Nom du référenciel invalide";
}

// Verification du id_regle_affichage
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/", $id_regle_affichage)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "ID de la règle invalide";
}

// Verification du titre
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,1000}$/", $titre)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "Titre de la règle invalide";
}

// Verification du description
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,1000}$/", $description)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "Description invalide";
}

if ($results["error"] === false && isset($_POST['validerecart'])) {

  $recupere_id_socle->bindParam(1, $nom_referentiel);
  $recupere_id_socle->execute();
  $id_socle_securite = $recupere_id_socle->fetch();
  print $id_socle_securite[0];

  $insere_regle->bindParam(1, $id_regle_affichage);
  $insere_regle->bindParam(2, $titre);
  $insere_regle->bindParam(3, $description);
  $insere_regle->bindParam(4, $etat_de_la_regle);
  $insere_regle->bindParam(5, $justification_ecart);
  $insere_regle->bindParam(6, $dates);
  $insere_regle->bindParam(7, $responsable);
  $insere_regle->bindParam(8, $id_socle_securite[0]);
  $insere_regle->execute();
  $_SESSION['message_success_2'] = "La règle a bien été ajoutée !";
}

header('Location: ../../../atelier-1d&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet'].'#regles');
?>