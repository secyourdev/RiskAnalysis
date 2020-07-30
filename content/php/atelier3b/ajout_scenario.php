<?php
session_start();

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];


$nom_scenario_strategique = $_POST['nom_scenario_strategique'];
$id_source_de_risque = $_POST['id_source_de_risque'];
$id_evenement_redoute = $_POST['id_evenement_redoute'];

// Verification du nom_scenario_strategique
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{0,100}$/", $nom_scenario_strategique)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Nom scénario strategique invalide";
}
// Verification du id_source_de_risque
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{0,100}$/", $id_source_de_risque)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Identifiant source de risque invalide";
}
// Verification du id_evenement_redoute
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{0,100}$/", $id_evenement_redoute)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Identifiant événement redouté invalide";
}

$id_atelier = '3.b';
$id_projet = $_SESSION['id_projet'];
$id_scenario = 'id_scenario';

$insere = $bdd->prepare(
  'INSERT INTO S_scenario_strategique 
  (id_scenario_strategique, nom_scenario_strategique, id_atelier, id_source_de_risque, id_evenement_redoute, id_projet)
   VALUES 
   ( ?, ?, ?, ?, ?, ?)'
);
$recupere_scenarios_existants = $bdd->prepare("SELECT nom_scenario_strategique FROM S_scenario_strategique WHERE S_scenario_strategique.id_projet = ?");

if ($results["error"] === false && isset($_POST['validerscenario'])) {

  $recupere_scenarios_existants->bindParam(1, $id_projet);
  $recupere_scenarios_existants->execute();
  $result_scenarios_existants = $recupere_scenarios_existants->fetchAll(PDO::FETCH_COLUMN);


  if (!in_array($nom_scenario_strategique, $result_scenarios_existants)) {
    //print 'chemin non existent';
  $insere->bindParam(1, $id_scenario);
  $insere->bindParam(2, $nom_scenario_strategique);
  $insere->bindParam(3, $id_atelier);
  $insere->bindParam(4, $id_source_de_risque);
  $insere->bindParam(5, $id_evenement_redoute);
  $insere->bindParam(6, $id_projet);

  $insere->execute();
  $_SESSION['message_success'] = "Le scénario stratégique a bien été ajouté !";
  } else {
    $_SESSION['message_error'] = "Le scénario stratégique entré existe déjà !";
  }
}
header('Location: ../../../atelier-3b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);
?>