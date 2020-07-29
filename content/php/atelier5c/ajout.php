<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$nom_risque_residuelle = $_POST['nom_risque_residuelle'];
$description_risque_residuelle = $_POST['description_risque_residuelle'];
$niveau_de_gravite = $_POST['niveau_de_gravite'];
$vraisemblance_residuelle = $_POST['vraisemblance_residuelle'];
$gestion_risque_residuelle = $_POST['gestion_risque_residuelle'];


$id_socle_securite = "id_socle_securite";
$id_atelier = "1.d";

$insere = $bdd->prepare("INSERT INTO X_revaluation_du_risque(
id_revaluation, 
nom_risque_residuelle, 
description_risque_residuelle, 
vraisemblance_residuelle, risque_residuel,
gestion_risque_residuelle, 
id_atelier, 
id_chemin_d_attaque_strategique, 
id_risque, 
id_projet
) 
 VALUES ('',?,?,?,?,?,?,?,?,?)");

// // Verification du nom_risque_residuelle
// if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/", $nom_risque_residuelle)) {
//   $results["error"] = true;
//   $_SESSION['message_error'] = "Type du nom_risque_residuelle invalide";
// }

// // Verification du description_risque_residuelle
// if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/", $description_risque_residuelle)) {
//   $results["error"] = true;
//   $_SESSION['message_error'] = "Nom invalide";
// }

// // Verification du niveau_de_gravite
// if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/", $niveau_de_gravite)) {
//   $results["error"] = true;
//   $_SESSION['message_error'] = "État de l'application invalide";
// }

// // Verification du vraisemblance_residuelle
// if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/", $vraisemblance_residuelle)) {
//   $results["error"] = true;
//   $_SESSION['message_error'] = "Commentaire invalide";
// }

if ($results["error"] === false && isset($_POST['validersocle'])) {
  $insere->bindParam(1, $id_socle_securite);
  $insere->bindParam(2, $nom_risque_residuelle);
  $insere->bindParam(3, $description_risque_residuelle);
  $insere->bindParam(4, $niveau_de_gravite);
  $insere->bindParam(5, $vraisemblance_residuelle);
  $insere->bindParam(6, $id_atelier);
  $insere->bindParam(7, $getid_projet);
  $insere->execute();

  $_SESSION['message_success'] = "Le socle de sécurité a bien été ajouté !";
}

header('Location: ../../../atelier-1d&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet'] . '#socle');
