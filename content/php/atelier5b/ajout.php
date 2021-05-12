<?php
session_start();
include("../bdd/connexion.php");
$get_id_projet = $_SESSION['id_projet'];

$results["error"] = false;
$results["message"] = [];

$id_chemin = $_POST['chemin'];
print $id_chemin;
$id_mesure = "id_mesure";
$id_traitement = "id_traitement";
$nom_mesure = $_POST['nommesure'];
print $nom_mesure;
$description_mesure = $_POST['descriptionmesure'];
// $dependance = $_POST['dependance'];
// $penetration = $_POST['penetration'];
// $maturite = $_POST['maturite'];
// $confiance = $_POST['confiance'];
// echo $dependance;
// echo $penetration;
// echo $maturite;
// echo $confiance;
$id_atelier = "5.b";
$insere_mesure = $bdd->prepare('INSERT INTO Y_mesure (id_mesure, nom_mesure, description_mesure, id_projet, id_atelier) VALUES ("", ?, ?, ?, ?)');
$recupere_mesure = $bdd->prepare('SELECT id_mesure FROM Y_mesure WHERE nom_mesure = ? AND description_mesure = ?');
$recupere_risque = $bdd->prepare('SELECT id_risque FROM T_chemin_d_attaque_strategique WHERE id_chemin_d_attaque_strategique = ?');


$insere2 = $bdd->prepare('INSERT INTO ZB_comporter_2 (id_mesure, id_chemin_d_attaque_strategique, id_risque) VALUES (?,?,?)');
$recupere_id_pp = $bdd->prepare('SELECT id_partie_prenante FROM T_chemin_d_attaque_strategique WHERE id_chemin_d_attaque_strategique = ?');
$recupere_pp = $bdd->prepare('SELECT ponderation_dependance, ponderation_penetration, ponderation_maturite, ponderation_confiance FROM R_partie_prenante WHERE id_partie_prenante = ?');
$insere_traitement = $bdd->prepare('INSERT INTO ZA_traitement_de_securite (id_traitement_de_securite, id_atelier, id_projet, id_mesure) VALUES (?, ?, ?, ?)');

$updatechemin = $bdd->prepare(
  'UPDATE T_chemin_d_attaque_strategique
  SET dependance_residuelle = ?,
  penetration_residuelle = ?,
  maturite_residuelle = ?,
  confiance_residuelle = ?,
  niveau_de_menace_residuelle = ?
  WHERE id_chemin_d_attaque_strategique = ?
  '
);

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
  // Insérer mesure
  $insere_mesure->bindParam(1, $nom_mesure);
  $insere_mesure->bindParam(2, $description_mesure);
  $insere_mesure->bindParam(3, $get_id_projet);
  $insere_mesure->bindParam(4, $id_atelier);
  $insere_mesure->execute();

  // Récupérer id de la mesure
  $recupere_mesure->bindParam(1, $nom_mesure);
  $recupere_mesure->bindParam(2, $description_mesure);
  $recupere_mesure->execute();
  $id_mesure = $recupere_mesure->fetch();

  // Recupérer id du risque
  $recupere_risque->bindParam(1, $id_chemin);
  $recupere_risque->execute();
  $id_risque = $recupere_risque->fetch();

  // Ajouter mesure à un chemin
  $insere2->bindParam(1, $id_mesure[0]);
  $insere2->bindParam(2, $id_chemin);
  $insere2->bindParam(3, $id_risque[0]);
  $insere2->execute();

  // Insérer un traitement de mesure
  $insere_traitement->bindParam(1, $id_traitement);
  $insere_traitement->bindParam(2, $id_atelier);
  $insere_traitement->bindparam(3, $get_id_projet);
  $insere_traitement->bindParam(4, $id_mesure[0]);
  $insere_traitement->execute();
  $_SESSION['message_success'] = "La mesure de sécurité a été correctement ajoutée!";
} 

header('Location: ../../../atelier5b.php?id_utilisateur=' . $_SESSION['id_utilisateur'] . '&id_projet=' . $_SESSION['id_projet'] . '#plan_amelioration_continue_de_la_securite');
